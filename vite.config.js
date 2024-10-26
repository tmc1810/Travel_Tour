import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                    'resources/css/styles-admin.css',
                    'resources/js/app.js',
                    'resources/js/styles-admin.js',
                    'resources/js/addUser-admin.js',
                    'resources/js/deleteUser-admin.js',
                    'resources/js/deleteLoaiTour-admin.js',
                    'resources/js/deleteTour-admin.js',
                    'resources/js/deleteHinhAnhTour-admin.js',
                    'resources/js/tour-admin.js',
                    'resources/js/datTour-admin.js',
                    'resources/js/theLoai-admin.js',
                    'resources/js/trangTinTuc-admin.js',
                    'resources/js/deleteTrangTinTuc-admin.js',
                    'resources/css/styles-user.css',
                    'resources/js/styles-user.js',
                    'resources/sass/app.scss',
                    'resources/css/styleHD-admin.css',
                    'resources/css/aboutus.css',
                    'resources/js/aboutus.js',
                    'resources/js/xemChiTietGopY.js',
            ],
            refresh: true,
        }),
    ],
});
