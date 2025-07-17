
  const slider = tns({
    container: '#hero-slider',
    items: 1, 
    slideBy: 'page',
    autoplay: true,
    autoplayButtonOutput: false,
    controls: false,
    nav: false,
    loop: true,
    speed: 800
  });

  const caption = document.getElementById('caption-display');
  const nameEl = caption.querySelector('.name');
  const quoteEl = caption.querySelector('.quote');

  function updateCaption(index) {
    const slides = document.querySelectorAll('#hero-slider .player-slide');
    const activeSlide = slides[index];
    const name = activeSlide.dataset.name;
    const quote = activeSlide.dataset.quote;

    nameEl.textContent = name;
    quoteEl.textContent = `"${quote}"`;
  }

  // Initialize
  updateCaption(slider.getInfo().index);

  // Listen for index change
  slider.events.on('indexChanged', () => {
    updateCaption(slider.getInfo().index);
  });
