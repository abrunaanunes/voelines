import './bootstrap';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import money from 'v-money3';
import {format as formatMoney} from 'v-money3';
import MoneyConfig from '@/config/money';
import Maska from 'maska';

const appName = window.document.getElementsByTagName('title')[0]?.innerText || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => require(`./Pages/${name}.vue`),
    setup({ el, app, props, plugin }) {
        return createApp({ render: () => h(app, props) })
            .use(plugin)
            .use(Maska)
            .mixin({ 
                methods: {
                    route,
                    formatMoney: (value) => (formatMoney(value, {...MoneyConfig, disableNegative: false})),
                    truncate: (text, length, clamp = '...') => {
                        return text.length > length ? text.slice(0, length) + clamp : text;
                    }, 
                    deleteConfirm(route) {
                        if (confirm('Deseja realmente excluir este item?')) {
                            return new Promise((resolve, reject) => {
                                this.$inertia.delete(route, {
                                    preserveState: true,
                                    preserveScroll: true,
                                    onSuccess: resolve,
                                    onError: reject
                                });
                            })
                        } 
                        return Promise.resolve()
                    },
                },
                computed: {
                    toast() {
                        if(!this.$page)
                            return
                        if(this.$page?.props?.timestamp) {
                        }

                        return this.$page.props?.flash?.toast
                    },

                    flash_alert() {
                        if(!this.$page)
                            return
                            
                        return this.$page.props?.flash?.alert
                    }
                },
                watch: {
                    toast: {
                        immediate: true,
                        handler(flash) {
                            if(flash){
                                const detail = JSON.parse(flash)
                                $toast.fire(detail.title, detail.message, detail.type);
                            }
                        }
                    },
                    flash_alert: {
                        immediate: true,
                        handler(flash) {
                            if(flash){
                                const detail = JSON.parse(flash)
                                Swal.fire(detail.title, detail.message, detail.type);
                            }
                        }
                    }
                }
            })
            .mount(el)
    },
});

InertiaProgress.init({ color: '#4B5563' });
