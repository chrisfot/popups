import NProgress from 'nprogress';

/**
 * NProgress default configuration object
 *
 * https://github.com/rstacruz/nprogress
 *
 * @type {{parent: string, showSpinner: boolean, minimum: number}}
 */
export const defaultConfig = {
    minimum: 0.2,
    // template: '<div>...</div>',
    // easing: 'easing',
    // speed: 200,
    // trickle: true,
    // trickleSpeed: 200,
    showSpinner: false,
    parent: '#app',
};

/**
 * Initializes NProgress on the given router instance
 *
 * @param router
 * @param config
 */
export const initProgressBar = (router, config = defaultConfig) => {

    NProgress.configure(config);

    router.beforeEach((to, from, next) => {
        // Avoid calling nprogress on first page load - the parent element has not loaded yet!
        if (document.querySelector(NProgress.settings.parent)) {
            NProgress.start();
        }
        next();
    });

    router.afterEach((to, from, next) => {
        NProgress.done();
    });

}
