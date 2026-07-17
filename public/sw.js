const CACHE_NAME = 'stayease-v1';
const STATIC_CACHE = 'stayease-static-v1';
const DYNAMIC_CACHE = 'stayease-dynamic-v1';

// URLs to cache on install
const PRECACHE_URLS = [
    '/',
    '/kamar',
    '/restaurant/menu',
    '/manifest.json',
    '/offline',
];

// Install event - cache static assets
self.addEventListener('install', event => {
    event.waitUntil(
        caches.open(STATIC_CACHE)
            .then(cache => {
                console.log('StayEase: Caching static assets');
                return cache.addAll(PRECACHE_URLS).catch(err => {
                    console.log('StayEase: Some URLs failed to cache during install');
                });
            })
            .then(() => self.skipWaiting())
    );
});

// Activate event - clean old caches
self.addEventListener('activate', event => {
    const cacheWhitelist = [CACHE_NAME, STATIC_CACHE, DYNAMIC_CACHE];
    event.waitUntil(
        caches.keys().then(cacheNames => {
            return Promise.all(
                cacheNames.map(cacheName => {
                    if (cacheWhitelist.indexOf(cacheName) === -1) {
                        console.log('StayEase: Deleting old cache:', cacheName);
                        return caches.delete(cacheName);
                    }
                })
            );
        }).then(() => self.clients.claim())
    );
});

// Fetch event - network first, fallback to cache
self.addEventListener('fetch', event => {
    // Skip non-GET requests and API calls
    if (event.request.method !== 'GET') return;
    if (event.request.url.includes('/api/') || event.request.url.includes('/payment/')) return;
    if (event.request.url.includes('/midtrans/')) return;

    // For HTML pages - network first
    if (event.request.headers.get('Accept')?.includes('text/html')) {
        event.respondWith(
            fetch(event.request)
                .then(response => {
                    // Save a copy to cache
                    const clone = response.clone();
                    caches.open(DYNAMIC_CACHE).then(cache => {
                        cache.put(event.request, clone);
                    });
                    return response;
                })
                .catch(() => {
                    // If offline, try cache
                    return caches.match(event.request).then(cached => {
                        if (cached) return cached;
                        // If not in cache, show offline page
                        return caches.match('/offline').catch(() => {
                            return new Response('Anda sedang offline. StayEase akan kembali saat Anda online.', {
                                status: 200,
                                headers: { 'Content-Type': 'text/html; charset=utf-8' }
                            });
                        });
                    });
                })
        );
        return;
    }

    // For static assets (CSS, JS, images, SVG icons) - cache first
    if (
        event.request.url.match(/\.(css|js|png|jpg|jpeg|gif|svg|ico|woff2?)$/) ||
        event.request.url.includes('cdn.jsdelivr.net') ||
        event.request.url.includes('fonts.googleapis.com') ||
        event.request.url.includes('images.unsplash.com')
    ) {
        event.respondWith(
            caches.match(event.request).then(cached => {
                if (cached) return cached;
                return fetch(event.request).then(response => {
                    const clone = response.clone();
                    caches.open(DYNAMIC_CACHE).then(cache => {
                        cache.put(event.request, clone);
                    });
                    return response;
                }).catch(() => {
                    // Return a fallback for images
                    if (event.request.url.match(/\.(png|jpg|jpeg|gif|svg)$/)) {
                        return new Response('', { status: 200, headers: { 'Content-Type': 'image/svg+xml' } });
                    }
                    return new Response('Resource unavailable offline', { status: 503 });
                });
            })
        );
        return;
    }

    // Default - network only
    event.respondWith(
        fetch(event.request).catch(() => {
            return caches.match(event.request);
        })
    );
});

// ─── Message event: handle SKIP_WAITING from update prompt ───
self.addEventListener('message', event => {
    if (event.data && event.data.type === 'SKIP_WAITING') {
        self.skipWaiting();
    }
});

// Sync event - for background sync (future use)
self.addEventListener('sync', event => {
    if (event.tag === 'sync-bookings') {
        event.waitUntil(syncBookings());
    }
});

// Push event - for push notifications (future use)
self.addEventListener('push', event => {
    const data = event.data?.json() ?? {};
    const title = data.title || 'StayEase';
    const options = {
        body: data.body || 'Ada pembaruan dari StayEase',
        icon: '/icons/icon-192x192.svg',
        badge: '/icons/icon-72x72.svg',
        vibrate: [100, 50, 100],
        data: { url: data.url || '/' }
    };
    event.waitUntil(self.registration.showNotification(title, options));
});

// Notification click event
self.addEventListener('notificationclick', event => {
    event.notification.close();
    const urlToOpen = event.notification.data?.url || '/';
    event.waitUntil(
        clients.matchAll({ type: 'window', includeUncontrolled: true }).then(windowClients => {
            for (const client of windowClients) {
                if (client.url === urlToOpen && 'focus' in client) {
                    return client.focus();
                }
            }
            if (clients.openWindow) {
                return clients.openWindow(urlToOpen);
            }
        })
    );
});
