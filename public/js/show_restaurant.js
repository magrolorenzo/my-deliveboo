/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, { enumerable: true, get: getter });
/******/ 		}
/******/ 	};
/******/
/******/ 	// define __esModule on exports
/******/ 	__webpack_require__.r = function(exports) {
/******/ 		if(typeof Symbol !== 'undefined' && Symbol.toStringTag) {
/******/ 			Object.defineProperty(exports, Symbol.toStringTag, { value: 'Module' });
/******/ 		}
/******/ 		Object.defineProperty(exports, '__esModule', { value: true });
/******/ 	};
/******/
/******/ 	// create a fake namespace object
/******/ 	// mode & 1: value is a module id, require it
/******/ 	// mode & 2: merge all properties of value into the ns
/******/ 	// mode & 4: return value when already ns object
/******/ 	// mode & 8|1: behave like require
/******/ 	__webpack_require__.t = function(value, mode) {
/******/ 		if(mode & 1) value = __webpack_require__(value);
/******/ 		if(mode & 8) return value;
/******/ 		if((mode & 4) && typeof value === 'object' && value && value.__esModule) return value;
/******/ 		var ns = Object.create(null);
/******/ 		__webpack_require__.r(ns);
/******/ 		Object.defineProperty(ns, 'default', { enumerable: true, value: value });
/******/ 		if(mode & 2 && typeof value != 'string') for(var key in value) __webpack_require__.d(ns, key, function(key) { return value[key]; }.bind(null, key));
/******/ 		return ns;
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "/";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 3);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/show_restaurant.js":
/*!*****************************************!*\
  !*** ./resources/js/show_restaurant.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports) {

var app = new Vue({
  el: "#app",
  data: {
    currentRestaurantId: "",
    dishes: [],
    cart: {
      KEY: 'cartContent-',
      contents: []
    }
  },
  methods: {
    getRestaurantId: function getRestaurantId() {
      this.currentRestaurantId = document.getElementById("restaurant-id").innerHTML;
    },
    add: function add(dishObj) {
      var id = dishObj.id;
      var name = dishObj.name;
      var unit_price = dishObj.unit_price;
      var newCartItem = {
        id: id,
        name: name,
        unit_price: unit_price,
        quantity: 1
      };
      var itemExists = false;

      for (var i = 0; i < this.cart.contents.length; i++) {
        // se presente nel carrello
        if (this.cart.contents[i].id == newCartItem.id) {
          // aggiungo la quantità
          this.cart.contents[i].quantity++;
          itemExists = true;
        }
      } // se non è nel carrello -> push


      if (!itemExists) {
        this.cart.contents.push(newCartItem);
      } // console.log(newCartItem);
      // console.log(this.cart.contents);
      // salvo nel localstorage


      var _cart = JSON.stringify(this.cart.contents);

      localStorage.setItem(this.cart.KEY + this.currentRestaurantId, _cart);
    }
  },
  // ***************** Mounted
  mounted: function mounted() {
    var self = this; // prendo l'id del ristorante

    self.getRestaurantId(); // prendo tutti i piatti del ristorante

    axios.get("http://localhost:8000/api/dishes/" + self.currentRestaurantId).then(function (response) {
      var thisRestaurantDishes = response.data.results;
      self.dishes = thisRestaurantDishes; // console.log(self.dishes);
    });
  }
});

/***/ }),

/***/ 3:
/*!***********************************************!*\
  !*** multi ./resources/js/show_restaurant.js ***!
  \***********************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\MAMP\htdocs\boolean\deliveboo\resources\js\show_restaurant.js */"./resources/js/show_restaurant.js");


/***/ })

/******/ });