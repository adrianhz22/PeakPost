import './bootstrap';
import './dropzone-config';
import './gallery';
import './trix';
import initKmlPreview from './track';

import Alpine from 'alpinejs';
import Swal from 'sweetalert2';

window.Alpine = Alpine;

Alpine.start();

document.addEventListener('DOMContentLoaded', () => {
    initKmlPreview('track', typeof map !== 'undefined' ? map : null);
});
