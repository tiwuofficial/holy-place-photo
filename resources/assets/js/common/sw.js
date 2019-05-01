const CACHE_NAME = '8';

const cacheByInstall = [
  '/img/icon/menu.svg',
  '/img/top.jpg'
];

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => {
      return cache.addAll(cacheByInstall);
    }).then(() => {
      self.skipWaiting();
    })
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keyList) => {
      return Promise.all(keyList.map((key) => {
        if (key !== CACHE_NAME) {
          return caches.delete(key);
        }
      }));
    }).then(() => {
      self.clients.claim();
    })
  );
});

self.addEventListener('fetch', (event) => {
  const url = new URL(event.request.url);
  if ([location.origin, 'https://res.cloudinary.com'].indexOf(url.origin) > -1) {
    event.respondWith(
        caches.open(CACHE_NAME).then((cache) => {
          return cache.match(event.request).then((response) => {
            return response || fetch(event.request).then((response) => {
              cache.put(event.request, response.clone());
              return response;
            });
          });
        })
    );
  }
});