// Service Worker for Workshop Pro Landing Page
// Provides offline functionality and performance optimization

const CACHE_NAME = 'workshop-pro-v1.2';
const STATIC_CACHE = 'workshop-pro-static-v1.2';
const DYNAMIC_CACHE = 'workshop-pro-dynamic-v1.2';

// Resources to cache immediately
const STATIC_ASSETS = [
    '/',
    '/css/app.css',
    '/js/app.js',
    '/js/performance-optimization.js',
    'https://fonts.bunny.net/css?family=inter:400,500,600,700,800&display=swap',
    'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css',
    'https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js'
];

// Dynamic content to cache with network-first strategy
const DYNAMIC_ASSETS = [
    'https://images.unsplash.com/',
    'https://randomuser.me/api/'
];

// Install event - cache static assets
self.addEventListener('install', event => {
    console.log('Service Worker: Installing...');
    
    event.waitUntil(
        caches.open(STATIC_CACHE)
            .then(cache => {
                console.log('Service Worker: Caching static assets');
                return cache.addAll(STATIC_ASSETS);
            })
            .then(() => {
                console.log('Service Worker: Static assets cached');
                return self.skipWaiting();
            })
            .catch(err => {
                console.log('Service Worker: Error caching static assets', err);
            })
    );
});

// Activate event - clean up old caches
self.addEventListener('activate', event => {
    console.log('Service Worker: Activating...');
    
    event.waitUntil(
        caches.keys()
            .then(cacheNames => {
                return Promise.all(
                    cacheNames
                        .filter(cacheName => {
                            return cacheName !== STATIC_CACHE && 
                                   cacheName !== DYNAMIC_CACHE &&
                                   cacheName.startsWith('workshop-pro-');
                        })
                        .map(cacheName => {
                            console.log('Service Worker: Deleting old cache', cacheName);
                            return caches.delete(cacheName);
                        })
                );
            })
            .then(() => {
                console.log('Service Worker: Activated');
                return self.clients.claim();
            })
    );
});

// Fetch event - serve cached content when offline
self.addEventListener('fetch', event => {
    const { request } = event;
    const url = new URL(request.url);
    
    // Skip non-GET requests
    if (request.method !== 'GET') {
        return;
    }
    
    // Handle navigation requests (HTML pages)
    if (request.mode === 'navigate') {
        event.respondWith(
            fetch(request)
                .then(response => {
                    // Clone response for cache
                    const responseClone = response.clone();
                    
                    // Cache the response
                    caches.open(DYNAMIC_CACHE)
                        .then(cache => {
                            cache.put(request, responseClone);
                        });
                    
                    return response;
                })
                .catch(() => {
                    // Serve from cache if offline
                    return caches.match('/') || 
                           caches.match(request) ||
                           new Response('Offline page not available', {
                               status: 200,
                               headers: { 'Content-Type': 'text/html' }
                           });
                })
        );
        return;
    }
    
    // Handle static assets (cache-first strategy)
    if (STATIC_ASSETS.some(asset => request.url.includes(asset))) {
        event.respondWith(
            caches.match(request)
                .then(response => {
                    if (response) {
                        return response;
                    }
                    
                    return fetch(request)
                        .then(fetchResponse => {
                            const responseClone = fetchResponse.clone();
                            
                            caches.open(STATIC_CACHE)
                                .then(cache => {
                                    cache.put(request, responseClone);
                                });
                            
                            return fetchResponse;
                        });
                })
                .catch(() => {
                    // Return fallback for critical resources
                    if (request.url.includes('.css')) {
                        return new Response('/* Offline CSS fallback */', {
                            headers: { 'Content-Type': 'text/css' }
                        });
                    }
                    if (request.url.includes('.js')) {
                        return new Response('// Offline JS fallback', {
                            headers: { 'Content-Type': 'application/javascript' }
                        });
                    }
                })
        );
        return;
    }
    
    // Handle images and external resources (network-first with cache fallback)
    if (request.destination === 'image' || 
        DYNAMIC_ASSETS.some(asset => request.url.includes(asset))) {
        event.respondWith(
            fetch(request)
                .then(response => {
                    // Only cache successful responses
                    if (response.status === 200) {
                        const responseClone = response.clone();
                        
                        caches.open(DYNAMIC_CACHE)
                            .then(cache => {
                                cache.put(request, responseClone);
                            });
                    }
                    
                    return response;
                })
                .catch(() => {
                    return caches.match(request)
                        .then(response => {
                            if (response) {
                                return response;
                            }
                            
                            // Return placeholder for images
                            if (request.destination === 'image') {
                                return new Response(
                                    '<svg xmlns="http://www.w3.org/2000/svg" width="400" height="300" viewBox="0 0 400 300"><rect width="400" height="300" fill="#f3f4f6"/><text x="200" y="150" text-anchor="middle" font-family="Arial" font-size="16" fill="#6b7280">Image unavailable offline</text></svg>',
                                    { headers: { 'Content-Type': 'image/svg+xml' } }
                                );
                            }
                            
                            return new Response('Resource unavailable offline');
                        });
                })
        );
        return;
    }
    
    // For all other requests, try network first, then cache
    event.respondWith(
        fetch(request)
            .then(response => {
                const responseClone = response.clone();
                
                caches.open(DYNAMIC_CACHE)
                    .then(cache => {
                        cache.put(request, responseClone);
                    });
                
                return response;
            })
            .catch(() => {
                return caches.match(request);
            })
    );
});

// Background sync for form submissions
self.addEventListener('sync', event => {
    if (event.tag === 'contact-form') {
        event.waitUntil(
            // Handle offline form submissions
            handleOfflineFormSubmission()
        );
    }
});

// Push notification handling
self.addEventListener('push', event => {
    const options = {
        body: event.data ? event.data.text() : 'New update available!',
        icon: '/icons/icon-192x192.png',
        badge: '/icons/badge-72x72.png',
        vibrate: [100, 50, 100],
        data: {
            dateOfArrival: Date.now(),
            primaryKey: 1
        },
        actions: [
            {
                action: 'explore',
                title: 'View Details',
                icon: '/icons/checkmark.png'
            },
            {
                action: 'close',
                title: 'Close',
                icon: '/icons/xmark.png'
            }
        ]
    };
    
    event.waitUntil(
        self.registration.showNotification('Workshop Pro', options)
    );
});

// Notification click handling
self.addEventListener('notificationclick', event => {
    event.notification.close();
    
    if (event.action === 'explore') {
        event.waitUntil(
            clients.openWindow('/')
        );
    }
});

// Helper function for offline form submissions
async function handleOfflineFormSubmission() {
    try {
        const cache = await caches.open(DYNAMIC_CACHE);
        const requests = await cache.keys();
        
        const formRequests = requests.filter(request => 
            request.url.includes('/contact') && request.method === 'POST'
        );
        
        for (const request of formRequests) {
            try {
                await fetch(request);
                await cache.delete(request);
            } catch (error) {
                console.log('Failed to sync form submission:', error);
            }
        }
    } catch (error) {
        console.log('Background sync failed:', error);
    }
}

// Cache management
self.addEventListener('message', event => {
    if (event.data && event.data.type === 'CACHE_UPDATE') {
        event.waitUntil(
            updateCache()
        );
    }
});

async function updateCache() {
    try {
        const cache = await caches.open(STATIC_CACHE);
        await cache.addAll(STATIC_ASSETS);
        console.log('Cache updated successfully');
    } catch (error) {
        console.log('Cache update failed:', error);
    }
}
