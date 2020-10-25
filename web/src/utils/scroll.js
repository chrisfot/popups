/**
 * Returns the vertical scroll position as a percentage.
 *
 * @returns {number}
 */
export const getVerticalScrollPercentage = () => {
    var h = document.documentElement,
        b = document.body,
        st = 'scrollTop',
        sh = 'scrollHeight';

    return (h[st]||b[st]) / ((h[sh]||b[sh]) - h.clientHeight) * 100;
};
