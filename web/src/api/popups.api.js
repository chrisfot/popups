import client from './client.js';

export const apiGetPages = () => {
    return client.get('/pages');
};

export const apiGetSinglePage = (page) => {
    return client.get('/page/' + page);
};

export const apiCreatePage = (title) => {
    const data = { title };
    return client.post('/page', data);
};

export const apiGetPopups = (page) => {
    return client.get('/page/' + page + '/popups');
};

export const apiCreatePopup = (page, title, content, timer, scroll, exit_intent, trigger_every) => {
    const data = { title, timer, scroll, exit_intent, trigger_every, content };
    return client.post('/page/' + page + '/popup', data);
};
