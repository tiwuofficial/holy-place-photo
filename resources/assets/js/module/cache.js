const cacheExpire = (url, cacheName) => {
  caches.open(cacheName).then((cache) => {
    cache.match(url).then((response) => {
      if (!response) {
        // キャッシュにない時
        cache.add(url);
        localStorage.setItem(url, Date.now());
      } else {
        // キャッシュにある時
        const time = localStorage.getItem(url);
        if (!time || Date.now() - time > 86400 * 1000) {
          // データの更新
          cache.delete(url).then(() => {
            cache.add(url);
            localStorage.setItem(url, Date.now());
          });
        }
      }
    });
  });
};

const cache = (url, cacheName) => {
  caches.open(cacheName).then((cache) => {
    cache.match(url).then((response) => {
      if (!response) {
        cache.delete(url.split('?')[0], {ignoreSearch: true}).then(() => {
          cache.add(url);
        });
      }
    });
  });
};

export {cache, cacheExpire};