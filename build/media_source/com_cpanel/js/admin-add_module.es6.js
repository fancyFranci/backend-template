/**
 * @copyright  Copyright (C) 2005 - 2019 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

Joomla = window.Joomla || {};

((document) => {
  'use strict';

  document.addEventListener('DOMContentLoaded', () => {
    const modal = document.querySelector('#moduleDashboardAddModal');
    const hiddenButtons = modal.querySelectorAll(':scope .modal-footer .btn.hidden');

    // Show 'save & close'-button in modal after selecting a module from the list
    window.jSelectModuleType = () => {
      Array.prototype.forEach.call(hiddenButtons, (hidden) => {
        hidden.classList.remove('hidden');
      });
    };

    // Pass on click to data-targets of modal footer buttons
    Array.prototype.forEach.call(modal.querySelectorAll(':scope .modal-footer .btn'), (button) => {
      button.addEventListener('click', (event) => {
        // There is some bug with events in iframe where currentTarget is "null"
        // => prevent this here by bubble up
        const elem = event.currentTarget || event.target;
        const target = elem.getAttribute('data-target');
        const iframe = modal.querySelector('iframe');
        const content = iframe.contentDocument || iframe.contentWindow.document;
        const clickTarget = content.querySelector(target);

        if (clickTarget) {
          clickTarget.click();

          if (target === '#saveBtn') {
            Joomla.renderMessages({ success: [Joomla.JText._('COM_CPANEL_MSG_MODULE_ADDED')] });
          }
        }
      });
    });

    // @TODO remove jQuery dependency, when the modal is not bootstrap anymore
    /* global jQuery */
    jQuery('#moduleDashboardAddModal').on('hide.bs.modal', () => {
      Array.prototype.forEach.call(hiddenButtons, (hide) => {
        hide.classList.add('hidden');
      });
    });
  });
})(document);
