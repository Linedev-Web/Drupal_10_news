/**
 * @file
 * JavaScript behaviors for the Test News theme.
 */

(function (Drupal) {
  'use strict';

  /**
   * Behavior for news teaser click redirection.
   */
  Drupal.behaviors.newsTeaser = {
    attach: function (context, settings) {
      const teasers = context.querySelectorAll('.news-teaser');

      teasers.forEach(function (teaser) {
        teaser.addEventListener('click', function (event) {
          if (!event.target.closest('a') && !event.target.closest('button')) {
            const detailLink = teaser.querySelector('.news-teaser__title a');

            if (detailLink && detailLink.href) {
              window.location.href = detailLink.href;
            }
          }
        });
      });
    }
  };

})(Drupal);