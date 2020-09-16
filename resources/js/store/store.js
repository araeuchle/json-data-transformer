import Vuex from 'vuex';
import Vue from 'vue';

Vue.use(Vuex);

export default new Vuex.Store({
    state: {
        items: [],
        currentIndex: 0,
        currentItem: {},
        viewMode: 'parse',
        searchField: 'Title',
    },
    getters: {
        takeSnapshot(state) {
            return {
                items: state.items,
                currentIndex: state.currentIndex,
                currentItem: state.currentItem
            }
        }
    },
    mutations: {
        setItems(state, items) {
            state.items = items
        },
        setViewMode(state, mode) {
            state.viewMode = mode
        },
        setCurrentItem(state, currentItem) {
            state.currentItem = currentItem;
        },
        setCurrentIndex(state, currentIndex) {
            state.currentIndex = currentIndex;
        },
        setSearchField(state, searchField) {
            state.searchField = searchField;
        }
    },
    actions: {
        setCurrentItem(context, item) {
            context.commit('setCurrentItem', item);
        },
        setItems(context, items) {
            context.commit('setItems', items);
        },
        setViewMode(context, mode) {
            context.commit('setViewMode', mode);
        },
        moveOn(context) {
            const nextIndex = context.state.currentIndex + 1;
            context.commit('setCurrentIndex', nextIndex);

            const nextItem = context.state.items[nextIndex];
            nextItem['Open_Time'] = nextItem['Open_Time'].replace(/Öffnungszeiten an Feiertagen Die Öffnungszeiten können abweichen./g, '-').trim();

            context.commit('setCurrentItem', nextItem);
        },
        moveBack(context) {
              const prevIndex = context.state.currentIndex - 1;
              context.commit('setCurrentIndex', prevIndex);

              const prevItem = context.state.items[prevIndex];
              context.commit('setCurrentItem', prevItem);
        },
        setSearchField(context, searchField) {
            context.commit('setSearchField', searchField);
        },
        restoreData(context, data) {
            context.commit('setItems', data.items);
            context.commit('setCurrentIndex', data.currentIndex);
            context.commit('setCurrentItem', data.currentItem);
        }
    }
});
