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
/******/ 	return __webpack_require__(__webpack_require__.s = 4);
/******/ })
/************************************************************************/
/******/ ({

/***/ "./resources/js/payment.js":
/*!*********************************!*\
  !*** ./resources/js/payment.js ***!
  \*********************************/
/*! no static exports found */
/***/ (function(module, exports) {

var app = new Vue({
  el: "#app",
  data: {
    customer_name: "",
    customer_surname: "",
    customer_email: "",
    delivery_address: "",
    currentRestaurantId: "",
    dishes: [],
    cart: {
      KEY: 'cartContent-',
      contents: [],
      subtotal: 0
    },
    JSONCart: ''
  },
  methods: {
    getRestaurantId: function getRestaurantId() {
      this.currentRestaurantId = document.getElementById("restaurant-id").innerHTML;
    },
    // Metodo per incrementare quantità di oggetti nel carrello
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
      } // calcolo il totale


      this.calculateSubtotal(); // aggiorno il local storage

      this.sync();
    },
    // Metodo per diminuire quantità di oggetti nel carrello
    decrease: function decrease(thisId) {
      var id = thisId;

      for (var i = 0; i < this.cart.contents.length; i++) {
        // se trovo l'id giusto entro nell'if
        if (this.cart.contents[i].id == id) {
          // controllo la quantità -> se =1 rimuovo dall'array
          if (this.cart.contents[i].quantity == 1) {
            // rimuovo il piatto dall'array
            this.remove(id);
          } else {
            // se !=1 riduco la quantità di 1
            this.cart.contents[i].quantity--;
          }
        } // se non trovo l'id non fa niente

      } // calcolo il totale


      this.calculateSubtotal(); // aggiorno il local storage

      this.sync();
    },
    // Rimuove elemento dal carrello
    remove: function remove(dish_id) {
      this.cart.contents = this.cart.contents.filter(function (item) {
        if (item.id !== dish_id) {
          return true;
        }
      });
    },
    // Sincronizza Vue con LocalStorage
    sync: function sync() {
      // salvo nel localstorage
      var _cart = JSON.stringify(this.cart.contents);

      localStorage.setItem(this.cart.KEY + this.currentRestaurantId, _cart);
      this.JSONCart = _cart; // console.log(_cart);
      // console.log(this.JSONCart);
    },
    empty: function empty() {
      // svuota il carrello
      this.cart.contents = []; // calcolo il totale

      this.calculateSubtotal(); // update localStorage

      this.sync();
    },
    // Ricalcola totale carrello
    calculateSubtotal: function calculateSubtotal() {
      this.cart.subtotal = 0;

      for (var i = 0; i < this.cart.contents.length; i++) {
        this.cart.subtotal = this.cart.subtotal + this.cart.contents[i].quantity * this.cart.contents[i].unit_price; // console.log(this.cart.subtotal);
      }
    },
    // controlla che non sia modificato il prezzo
    priceCheck: function priceCheck() {
      var _this = this;

      console.log("in funzione check");
      var thisRestaurantDishes; // prendo tutti i piatti del ristorante

      axios.get("http://localhost:8000/api/dishes/" + this.currentRestaurantId).then(function (response) {
        console.log("in chiamata ajax"); // mi salvo tutti i piatti del ristorante

        thisRestaurantDishes = response.data.results;
        console.log(thisRestaurantDishes); // prendo i dati dall'input nascosto e controllo che non sia stato cambiato il prezzo

        var currentInputCart = _this.JSONCart;
        console.log("carrello di input modificato");
        console.log(currentInputCart);
        var currentInputArrayCart = JSON.parse(currentInputCart);
        console.log("carrello array modificato");
        console.log(currentInputArrayCart);
        var checkArray; // array di controllo -> se vuoto OK

        checkArray = currentInputArrayCart.filter(function (item) {
          var isCorrectPrice = false; // var appoggio se vera il prezzo è giusto

          console.log("id del piatto in vue");
          console.log(item.id); // ciclo tutti i piatti del ristorante

          thisRestaurantDishes.forEach(function (databaseItem, i) {
            console.log("piatto database id");
            console.log(databaseItem.id);

            if (item.id == databaseItem.id && item.unit_price == databaseItem.unit_price) {
              isCorrectPrice = true;
              console.log("sono uguali");
            }
          });
          return !isCorrectPrice;
        });
        console.log(checkArray); // final check

        if (checkArray.length == 0) {
          // array controllo vuoto -> ok : submit il form
          console.log("ARRAY NON MODIFICATO");
        } else {
          // errore rigenera la pagina
          console.log("ARRAY MODIFICATO");
        }
      }); // fine chiamata di controllo
    }
  },
  // ***************** Mounted
  mounted: function mounted() {
    var self = this; // prendo l'id del ristorante

    self.getRestaurantId();

    var _contents = localStorage.getItem(this.cart.KEY + this.currentRestaurantId);

    if (_contents) {
      this.cart.contents = JSON.parse(_contents);
      this.calculateSubtotal();
    }

    this.sync();
  }
}); // ***************************************** Braintree
// Copiato script in fondo alla  pagina index della repo di demo di braintree

var form = document.querySelector('#payment-form');
var client_token = document.getElementById("token").innerHTML;
braintree.dropin.create({
  authorization: client_token,
  selector: '#bt-dropin'
}, function (createErr, instance) {
  if (createErr) {
    console.log('Create Error', createErr);
    return;
  }

  form.addEventListener('submit', function (event) {
    event.preventDefault();
    instance.requestPaymentMethod(function (err, payload) {
      if (err) {
        console.log('Request Payment Method Error', err);
        return;
      } // Add the nonce to the form and submit


      document.querySelector('#nonce').value = payload.nonce;
      form.submit();
    });
  });
});

/***/ }),

/***/ 4:
/*!***************************************!*\
  !*** multi ./resources/js/payment.js ***!
  \***************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! C:\MAMP\htdocs\proj_boolean\20210214_deliveboo\deliveboo\resources\js\payment.js */"./resources/js/payment.js");


/***/ })

/******/ });