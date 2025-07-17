import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import { tns } from "tiny-slider/src/tiny-slider";
import 'tiny-slider/dist/tiny-slider.css';


window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});

document.addEventListener('DOMContentLoaded', () => {
    const forms = document.querySelectorAll('form');

    forms.forEach(form => {
        form.addEventListener('submit', () => {
            window.dispatchEvent(new CustomEvent('show-loading'));
        });
    });

    window.addEventListener('pageshow', () => {
        window.dispatchEvent(new CustomEvent('hide-loading'));
    });
});

document.addEventListener('DOMContentLoaded', () => {
    tns({
        container: '#player-profiles',
        items: 3,
        slideBy: 1,
        autoplay: true,
        autoplayButtonOutput: false,
        controls: false,
        nav: true,
        navPosition: 'bottom',
        mouseDrag: true,
        gutter: 0,
        edgePadding: 10,
        center: true,
        autoplayHoverPause: true,
    });
});

document.addEventListener('DOMContentLoaded', () => {
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
});

document.addEventListener('DOMContentLoaded', () => {
  tns({
    container: '#news-carousel',
    items: 1,
    slideBy: 'page',
    autoplay: true,
    autoplayTimeout: 5000,
    autoplayButtonOutput: false,
    controls: false,
    nav: true,
    navPosition: 'bottom',
    loop: true,
    mouseDrag: true,
    touch: true,
    speed: 600,
  });
});

  document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.getElementById("searchInput");
    const filterButtons = document.querySelectorAll(".filter-tab");
    const tableRows = document.querySelectorAll(".admin-table tbody tr");

    let currentFilter = ""; // default to All

    // Filter logic
    function filterTable() {
      const searchValue = searchInput.value.toLowerCase();

      tableRows.forEach((row) => {
        const rowStatus = row.getAttribute("data-status");
        const rowText = row.innerText.toLowerCase();

        const matchesStatus = currentFilter === "" || rowStatus === currentFilter;
        const matchesSearch = rowText.includes(searchValue);

        if (matchesStatus && matchesSearch) {
          row.style.display = "";
        } else {
          row.style.display = "none";
        }
      });
    }

    // Handle search input
    searchInput.addEventListener("input", filterTable);

    // Handle filter button clicks
    filterButtons.forEach((button) => {
      button.addEventListener("click", () => {
        // Remove active class from all buttons
        filterButtons.forEach(btn => btn.classList.remove("active-tab"));

        // Add active class to clicked one
        button.classList.add("active-tab");

        currentFilter = button.dataset.filter.trim();
        filterTable();
      });
    });
  });

document.addEventListener('DOMContentLoaded', () => {
    const searchInputs = document.querySelectorAll('.table-search');

    searchInputs.forEach(input => {
        input.addEventListener('keyup', function() {
            const filter = this.value.toLowerCase();

            // find the closest .inverted-radius-content container
            const container = this.closest('.inverted-radius-content');

            // find the table within this container
            const table = container.querySelector('.searchable-table');

            if (!table) return;

            const rows = table.getElementsByTagName('tr');

            for (let i = 1; i < rows.length; i++) { // skip header
                const row = rows[i];
                const cells = row.getElementsByTagName('td');
                let match = false;
                for (let j = 0; j < cells.length; j++) {
                    const cellText = cells[j].textContent.toLowerCase();
                    if (cellText.includes(filter)) {
                        match = true;
                        break;
                    }
                }
                row.style.display = match ? '' : 'none';
            }
        });
    });
});