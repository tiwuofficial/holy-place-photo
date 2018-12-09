var CACHE_NAME = 'my-site-cache-v1';
var urlsToCache = [
  '/dist/js/top/index.js',
    '/photos/5'
];

self.addEventListener('install', (e) => {
  console.log('ServiceWorker install');
  e.waitUntil(
      caches.open(CACHE_NAME)
          .then(function(cache) {
            console.log('Opened cache');
            return cache.addAll(urlsToCache);
          })
  );
});

self.addEventListener('fetch', function(event) {
  event.respondWith(
      caches.open(CACHE_NAME).then(function(cache) {
        return cache.match(event.request).then(function(response) {
          let fetchPromise = fetch(event.request).then(function(networkResponse) {
            cache.put(event.request, networkResponse.clone());
            return networkResponse;
          });
          return response || fetchPromise;
        })
      })
  );
});