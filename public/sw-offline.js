workbox.skipWaiting();
workbox.clientsClaim();

// static
workbox.routing.registerRoute(
    new RegExp('/dist'),
    workbox.strategies.cacheFirst({
      cacheName: 'static'
    }),
);
