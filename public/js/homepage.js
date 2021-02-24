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
/******/ 	return __webpack_require__(__webpack_require__.s = 1);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/homepage.js":
/*!**********************************!*\
  !*** ./resources/js/homepage.js ***!
  \**********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var app = new Vue({
  el: "#app",
  data: {
    categories: [],
    selectedCategories: [],
    restaurants: [],
    url_base: "http://localhost:8000/storage/"
  },
  methods: {
    // Metodo per ricaricare tutti i ristoranti
    loadRestaurants: function loadRestaurants() {
      var _this = this;

      axios.get("http://localhost:8000/api/restaurants").then(function (response) {
        var all_restaurants = response.data.results;
        _this.restaurants = all_restaurants;
      });
    },
    // Metodo per svuotare i filtri categorie
    clearCategories: function clearCategories() {
      if (this.selectedCategories.length > 0) {
        this.selectedCategories = [];
        this.restaurants = [];
        this.loadRestaurants();
      }

      ;
    },
    // Metodo per filtrare i ristoranti con click su bottone categoria
    selectedCategory: function selectedCategory(category_id) {
      var _this2 = this;

      // Se la categoria non è presente, aggiungo ristoranti
      if (!this.selectedCategories.includes(category_id)) {
        // Se è la prima categoria selezionata, svuoto array e faccio chiamata ajax
        if (this.selectedCategories.length == 0) {
          axios.get("http://localhost:8000/api/filtered-restaurants/" + category_id).then(function (response) {
            var selected_restaurants = response.data.results;
            _this2.restaurants = [];
            _this2.restaurants = selected_restaurants;

            _this2.selectedCategories.push(category_id);
          });
        } else {
          // Altrimenti aggiungo i nuovi ristoranti filtrati nell array
          axios.get("http://localhost:8000/api/filtered-restaurants/" + category_id).then(function (response) {
            var selected_restaurants = response.data.results;

            var _loop = function _loop(index) {
              // Se un ristorante con più categorie è già presente, non lo riaggungo
              selected_restaurants = selected_restaurants.filter(function (item) {
                return item.id !== _this2.restaurants[index].id;
              });
            };

            for (var index = 0; index < _this2.restaurants.length; index++) {
              _loop(index);
            }

            _this2.selectedCategories.push(category_id);

            _this2.restaurants = _this2.restaurants.concat(selected_restaurants);
          });
        }
      } else {
        // Array di salvataggio ID ristoranti da eliminare
        var res_id = []; // Rimuovo category_id dall'array dei filtri applicati

        this.selectedCategories = this.selectedCategories.filter(function (item) {
          return item !== category_id;
        }); // Rimuovo i ristoranti che non hanno categorie filtrate

        for (var i = 0; i < this.restaurants.length; i++) {
          var res = this.restaurants[i];
          var remove_restaurant = true; // Ciclo gli obj categorie di ogni ristorante

          for (var j = 0; j < res.categories.length; j++) {
            var cat = res.categories[j];

            if (this.selectedCategories.includes(cat.id)) {
              remove_restaurant = false;
            }

            ;
          }

          ;

          if (remove_restaurant) {
            res_id.push(res.id);
          }

          ;
        }

        ; // rimuovo i ristoranti dall'array

        this.restaurants = this.restaurants.filter(function (item) {
          return !res_id.includes(item.id);
        }); // Se non hai più categorie selezionate, mostra tutti i ristoranti

        if (this.restaurants.length == 0) {
          this.loadRestaurants();
        }

        ;
      }

<<<<<<< HEAD
      ;
    },
    moveRight: function moveRight() {
      document.getElementById('cat').scrollLeft += 700;
    },
    moveLeft: function moveLeft() {
      document.getElementById('cat').scrollLeft -= 700;
    }
=======
      ; // Chiusura else
    } // Chiusura metodo per filtrare categorie

>>>>>>> lorenzo_cart
  },
  // ***************** Mounted *****************
  mounted: function mounted() {
    var _this3 = this;

    // Carica tutte le categorie
    axios.get("http://localhost:8000/api/categories").then(function (response) {
      var all_categories = response.data.results;
      _this3.categories = all_categories;
    }); // Carica tutti i ristoranti

    axios.get("http://localhost:8000/api/restaurants").then(function (response) {
      var all_restaurants = response.data.results;
      _this3.restaurants = all_restaurants;
    });
  }
});

/***/ }),

/***/ 1:
/*!****************************************!*\
  !*** multi ./resources/js/homepage.js ***!
  \****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

<<<<<<< HEAD
module.exports = __webpack_require__(/*! C:\MAMP\htdocs\bool18\deliveboo\resources\js\homepage.js */"./resources/js/homepage.js");
=======
module.exports = __webpack_require__(/*! C:\MAMP\htdocs\boolean\deliveboo\resources\js\homepage.js */"./resources/js/homepage.js");
>>>>>>> lorenzo_cart


/***/ })

/******/ });