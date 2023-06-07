import { createStore } from 'vuex';
const CART_ITEMS_KEY = 'cart_items';
const store = createStore({
      state: {
        cartItems: JSON.parse(localStorage.getItem(CART_ITEMS_KEY)) || [],
      },
      mutations: {
        addToCart(state, item) {
          const existingItem = state.cartItems.find((cartItem) => cartItem.id === item.id);
          if (existingItem) {
            existingItem.quantity += 1;
          } else {
            state.cartItems.push({ ...item, quantity: 1 });
          }
          localStorage.setItem(CART_ITEMS_KEY, JSON.stringify(state.cartItems));
        },
        removeFromCart(state, index) {
          state.cartItems.splice(index, 1);
          localStorage.setItem(CART_ITEMS_KEY, JSON.stringify(state.cartItems));
        },
        clearCart(state) {
          state.cartItems = [];
          localStorage.removeItem(CART_ITEMS_KEY);
        },
        increaseQuantity(state, index) {
            state.cartItems[index].quantity += 1;
            localStorage.setItem(CART_ITEMS_KEY, JSON.stringify(state.cartItems));
          },
        decreaseQuantity(state, index) {
            if (state.cartItems[index].quantity > 1) {
              state.cartItems[index].quantity -= 1;
              localStorage.setItem(CART_ITEMS_KEY, JSON.stringify(state.cartItems));
            }
          },
      },
      actions: {
        addToCart({ commit }, item) {
          commit('addToCart', item);
        },
        removeFromCart({ commit }, index) {
          commit('removeFromCart', index);
        },
        clearCart({ commit }) {
          commit('clearCart');
        },
      },
      getters: {
        cartItemsCount: (state) => {
          let count = 0;
          for (const item of state.cartItems) {
            count += item.quantity;
          }
          return count;
        },
        cartItems: (state) => {
          return state.cartItems.map((item) => {
            return {
              ...item,
              totalPrice: item.price * item.quantity,
            };
          });
        },
        cartTotalPrice: (state) => {
          let totalPrice = 0;
          for (const item of state.cartItems) {
            totalPrice += item.price * item.quantity;
          }
          return totalPrice;
        },
      },
    //   mutations: {
    //     addToCart(state, item) {
    //       state.cartItems.push(item);
    //       localStorage.setItem(CART_ITEMS_KEY, JSON.stringify(state.cartItems));
    //     },
    //     removeFromCart(state, itemIndex) {
    //       state.cartItems.splice(itemIndex, 1);
    //       localStorage.setItem(CART_ITEMS_KEY, JSON.stringify(state.cartItems));
    //     },
    //     clearCart(state) {
    //       state.cartItems = [];
    //       localStorage.removeItem(CART_ITEMS_KEY);
    //     },
    //   },
    //   actions: {
    //     addToCart({ commit }, item) {
    //       commit('addToCart', item);
    //     },
    //     removeFromCart({ commit }, itemIndex) {
    //       commit('removeFromCart', itemIndex);
    //     },
    //     clearCart({ commit }) {
    //       commit('clearCart');
    //     },
    //   },
    //   getters: {
    //     cartItemsCount: (state) => {
    //       return state.cartItems.length;
    //     },
    //   },
});

export default store;
