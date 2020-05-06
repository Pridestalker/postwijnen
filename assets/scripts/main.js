import $ from 'jquery';

import Router from './tools/Router';
import common from './routes/Common';
import home from './routes/Home';

const routes = new Router({
    common,
    home
});

window.routes = routes;

$(document).ready(() => routes.loadEvents());
