// Import de Bootstrap
import 'bootstrap';

// Import d'Axios
import axios from 'axios';
window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

// Vous pouvez ajouter d'autres scripts JavaScript ici
