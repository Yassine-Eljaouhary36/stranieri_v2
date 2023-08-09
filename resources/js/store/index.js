import { createApp } from 'vue'
import Vuex from 'vuex';
const app = createApp({})
app.use(Vuex);

export default new Vuex.Store({
  state: {
    selectedMeetings: [],
  },
  mutations: {
    addToCart(state, meeting) {
      state.selectedMeetings.push(meeting);
    },
  },
  actions: {
    addMeetingToCart({ commit }, meeting) {
      commit('addToCart', meeting);
    },
  },
});
