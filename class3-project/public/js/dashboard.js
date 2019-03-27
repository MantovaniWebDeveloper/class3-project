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

/***/ "./resources/js/dashboard.js":
/*!***********************************!*\
  !*** ./resources/js/dashboard.js ***!
  \***********************************/
/*! no static exports found */
/***/ (function(module, exports) {

$('.off_state, .on_state').click(function () {
  //collego listener
  manageClick($(this));
});

function manageClick(element) {
  //ignoro click su elemento attivo
  if (!element.hasClass('active')) {
    if (element.hasClass('off_state')) {
      //nascondo un annuncio nei risultati di ricerca
      setApartmentVisibility(element, 0);
    } else if (element.hasClass('on_state')) {
      //mostro un annuncio nei risultati di ricerca
      setApartmentVisibility(element, 1);
    }
  }
}

function setApartmentVisibility(element, visible) {
  var slug = $(element).data('slug');
  var url = 'http://127.0.0.1:8000/api/apartment/visibility';
  $.ajax(url, {
    beforeSend: function beforeSend() {
      standBy(slug);
    },
    method: 'PATCH',
    headers: {
      'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    success: function success(result) {
      //cambio stato pulsante
      if (result) {
        setState(slug, visible);
      } else {
        //qualcosa non ha funzionato
        setState(slug, !visible);
      }
    },
    error: function error() {
      //se c'è un errore ripristino lo stato precedente del pulsante
      setState(slug, !visible);
    },
    data: {
      visible: visible,
      slug: slug
    }
  });
}

function standBy(slug) {
  //disconnetto listener e mostro standby
  var elements = $('[data-slug="' + slug + '"]');
  elements.off();
  elements.removeClass('active');
  $('.standby_state[data-slug="' + slug + '"]').addClass('active');
}

function setState(slug, onState) {
  //mostro il nuovo stato e riconnetto listener
  $('[data-slug="' + slug + '"]').removeClass('active');
  var onStateElement = $('.on_state[data-slug="' + slug + '"]');
  var offStateElement = $('.off_state[data-slug="' + slug + '"]');

  if (onState) {
    onStateElement.addClass('active');
  } else {
    offStateElement.addClass('active');
  }

  onStateElement.click(function () {
    manageClick($(this));
  });
  offStateElement.click(function () {
    manageClick($(this));
  });
}

/***/ }),

/***/ 4:
/*!*****************************************!*\
  !*** multi ./resources/js/dashboard.js ***!
  \*****************************************/
/*! no static exports found */
/***/ (function(module, exports, __webpack_require__) {

module.exports = __webpack_require__(/*! /Users/emanuelemazzante/WorkingDirectory/Esercizi_Boolean/apache_default/project_classe_3/class3-project/resources/js/dashboard.js */"./resources/js/dashboard.js");


/***/ })

/******/ });