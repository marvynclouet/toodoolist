import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
  plugins: [
    laravel({
      input: [
        'resources/css/app.css',
        'resources/css/custom.css',
        'resources/js/app.js',
        'resources/css/custom.css'
      ],
      refresh: true, // Enable auto-refresh
    }),
  ],
});
