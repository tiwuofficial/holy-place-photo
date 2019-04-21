import '../../module/service-worker';

window.addEventListener('load', () => {
  ['photo-list.js', 'photo-card.js', 'anime-list.js', 'anime-card.js'].forEach(url => {
    const script = document.createElement('script');
    script.src = `/web-components/${url}`;
    script.type = 'module';
    document.body.appendChild(script);
  });
});
