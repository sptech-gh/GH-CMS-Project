export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/components.css", // ✅ add this
                "resources/js/app.js",
            ],
            refresh: true,
        }),
    ],
});
