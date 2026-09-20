'use strict';

document.addEventListener('DOMContentLoaded', init);

function init() {
  const noscript = document.querySelectorAll('.noscript');
  noscript.forEach(i => i.classList.remove('noscript'));

  const copyBtns = document.querySelectorAll('button[data-copytext]');

  copyBtns.forEach(btn => {
    btn.addEventListener('click', () => {
      const copyText = btn.dataset.copytext;
      
      navigator.clipboard.writeText(copyText);
      
      btn.textContent = "Link Copied!";
      btn.ariaLive = 'off';
      btn.blur();
      
      setTimeout(function() {
        btn.textContent = "Copy Link";
        btn.ariaLive = 'assertive';
      }, 3000);
    });
  });
}
