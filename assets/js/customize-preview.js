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
/******/ 	__webpack_require__.p = "";
/******/
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = "./.dev/assets/admin/js/customize-preview.js");
/******/ })
/************************************************************************/
/******/ ({

/***/ "./.dev/assets/admin/js/customize-preview.js":
/*!***************************************************!*\
  !*** ./.dev/assets/admin/js/customize-preview.js ***!
  \***************************************************/
/*! no exports provided */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _customize_preview_design_style__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./customize/preview/design-style */ "./.dev/assets/admin/js/customize/preview/design-style.js");
/* harmony import */ var _customize_preview_header__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./customize/preview/header */ "./.dev/assets/admin/js/customize/preview/header.js");
/* harmony import */ var _customize_preview_footer__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(/*! ./customize/preview/footer */ "./.dev/assets/admin/js/customize/preview/footer.js");
/* harmony import */ var _customize_preview_color_schemes__WEBPACK_IMPORTED_MODULE_3__ = __webpack_require__(/*! ./customize/preview/color-schemes */ "./.dev/assets/admin/js/customize/preview/color-schemes.js");
/* harmony import */ var _customize_preview_logo_sizing__WEBPACK_IMPORTED_MODULE_4__ = __webpack_require__(/*! ./customize/preview/logo-sizing */ "./.dev/assets/admin/js/customize/preview/logo-sizing.js");
/* harmony import */ var _customize_preview_page_titles__WEBPACK_IMPORTED_MODULE_5__ = __webpack_require__(/*! ./customize/preview/page-titles */ "./.dev/assets/admin/js/customize/preview/page-titles.js");






Object(_customize_preview_design_style__WEBPACK_IMPORTED_MODULE_0__["default"])();
Object(_customize_preview_header__WEBPACK_IMPORTED_MODULE_1__["default"])();
Object(_customize_preview_footer__WEBPACK_IMPORTED_MODULE_2__["default"])();
Object(_customize_preview_color_schemes__WEBPACK_IMPORTED_MODULE_3__["default"])();
Object(_customize_preview_logo_sizing__WEBPACK_IMPORTED_MODULE_4__["default"])();
Object(_customize_preview_page_titles__WEBPACK_IMPORTED_MODULE_5__["default"])();

/***/ }),

/***/ "./.dev/assets/admin/js/customize/preview/color-schemes.js":
/*!*****************************************************************!*\
  !*** ./.dev/assets/admin/js/customize/preview/color-schemes.js ***!
  \*****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../util */ "./.dev/assets/admin/js/customize/util.js");

const $ = jQuery; // eslint-disable-line

/* harmony default export */ __webpack_exports__["default"] = (() => {
  let selectedDesignStyle = GoPreviewData.selectedDesignStyle;
  /**
   * Set color
   *
   * @param {*} color
   */

  const setColor = (color, cssVar) => {
	const hsl = Object(_util__WEBPACK_IMPORTED_MODULE_0__["hexToHSL"])(color);
	document.querySelector(':root').style.setProperty(`${cssVar}`, `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)`);
  };
  /**
   * Load the color schemes for the selected design style.
   */


  const loadColorSchemes = colorScheme => {
	const designStyle = getDesignStyle(selectedDesignStyle);
	colorScheme = colorScheme.replace(`${selectedDesignStyle}-`, '');

	if ('undefined' !== typeof designStyle.color_schemes[colorScheme] && 'undefined' !== typeof wp.customize.settings.controls) {
	  const colors = designStyle.color_schemes[colorScheme];
	  toggleColorSchemes();
	  setTimeout(function () {
		updateViewportBasis(designStyle);
	  }, 200);
	  Object.entries(wp.customize.settings.controls).filter(([_control, config]) => config.type === 'color').forEach(([customizerControl, config]) => {
		const customizerSetting = wp.customize(config.settings.default);
		const color = colors[config.settings.default.replace('_color', '')] || '';
		customizerSetting.set(color);
		wp.customize.control(customizerControl).container.find('.color-picker-hex').data('data-default-color', color).wpColorPicker('defaultColor', color).trigger('change');
	  });
	}
  };
  /**
   * Control the visibility of the color schemes selections.
   */


  const toggleColorSchemes = () => {
	$('label[for^=color_scheme_control]').hide();
	$(`label[for^=color_scheme_control-${selectedDesignStyle}-]`).show();
  };
  /**
   * Update the viewport basis for the selected design style.
   */


  const updateViewportBasis = designStyle => {
	let viewportBasis = 'undefined' !== typeof designStyle.viewport_basis ? designStyle.viewport_basis : '950';
	wp.customize.control('viewport_basis').setting(viewportBasis);
  };
  /**
   * Returns the design style array
   *
   * @param {*} designStyle
   */


  const getDesignStyle = designStyle => {
	if ('undefined' !== typeof GoPreviewData['design_styles'] && 'undefined' !== GoPreviewData['design_styles'][designStyle]) {
	  return GoPreviewData['design_styles'][designStyle];
	}

	return false;
  };

  wp.customize.bind('ready', () => toggleColorSchemes());
  wp.customize('design_style', value => {
	selectedDesignStyle = value.get();
	value.bind(to => {
	  selectedDesignStyle = to;
	  loadColorSchemes('one');
	  $(`#color_scheme_control-${selectedDesignStyle}-one`).prop('checked', true);
	});
  });
  wp.customize('color_scheme', value => {
	value.bind(colorScheme => loadColorSchemes(colorScheme));
  });
  wp.customize('background_color', value => {
	value.bind(to => setColor(to, '--go--color--background'));
  });
  wp.customize('primary_color', value => {
	value.bind(to => setColor(to, '--go--color--primary'));
  });
  wp.customize('secondary_color', value => {
	value.bind(to => setColor(to, '--go--color--secondary'));
  });
  wp.customize('tertiary_color', value => {
	value.bind(to => setColor(to, '--go--color--tertiary'));
  });
});

/***/ }),

/***/ "./.dev/assets/admin/js/customize/preview/design-style.js":
/*!****************************************************************!*\
  !*** ./.dev/assets/admin/js/customize/preview/design-style.js ***!
  \****************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
const $ = jQuery; // eslint-disable-line

/* harmony default export */ __webpack_exports__["default"] = (() => {
  wp.customize('design_style', value => {
	value.bind(to => {
	  $('#customize-preview').addClass('is-loading');

	  if ('undefined' !== typeof GoPreviewData['design_styles'] && 'undefined' !== GoPreviewData['design_styles'][to]) {
		setTimeout(function () {
		  const designStyle = GoPreviewData['design_styles'][to];
		  $('link[id*="design-style"]').attr('href', designStyle['url']);
		  setTimeout(function () {
			$('#customize-preview').removeClass('is-loading');
		  }, 500);
		}, 500); // match the .02s transition time from core
	  }
	});
  });
  /**
   * Set viewport basis
   *
   * @param {*} size
   */

  const setViewportBasis = size => {
	document.documentElement.style.setProperty('--go--viewport-basis', size ? size : '1000');
  };

  wp.customize('viewport_basis', value => {
	value.bind(to => setViewportBasis(to));
  });
});

/***/ }),

/***/ "./.dev/assets/admin/js/customize/preview/footer.js":
/*!**********************************************************!*\
  !*** ./.dev/assets/admin/js/customize/preview/footer.js ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../util */ "./.dev/assets/admin/js/customize/util.js");

const $ = jQuery; // eslint-disable-line

$(document).ready(setMenuLocationDescription);
/* harmony default export */ __webpack_exports__["default"] = (() => {
	wp.customize('footer_variation', value => {
		value.bind(to => {
			$('body').removeClass('has-footer-1 has-footer-2 has-footer-3 has-footer-4').addClass('has-' + to);
			setMenuLocationDescription();
		});
	});
	wp.customize('copyright', function (value) {
		value.bind(function (to) {
			$('.copyright').html(to);
		});
	});
	wp.customize('footer_widgets_background_color', value => {
		value.bind(to => {
			const hsl = Object(_util__WEBPACK_IMPORTED_MODULE_0__["hexToHSL"])(to);
			const setTo = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : 'var( --go--color--tertiary )';
			document.querySelector(':root').style.setProperty('--gf-footer-widgets--background-color', setTo);

			// Add class if a background color is applied.
			if (to) {
				$('body').addClass('has-footer-widgets-background');
				$('.footer-widgets').addClass('has-background');
			} else {
				$('body').removeClass('has-footer-widgets-background');
				$('.footer-widgets').removeClass('has-background');
			}
		});
	});
	wp.customize('footer_background_color', value => {
		value.bind(to => {
			const hsl = Object(_util__WEBPACK_IMPORTED_MODULE_0__["hexToHSL"])(to);
			const setTo = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : undefined;
			document.querySelector(':root').style.setProperty('--go-footer--color--background', setTo);

			// Add class if a background color is applied.
			if (to) {
				$('body').addClass('has-footer-background');
				$('.site-footer').addClass('has-background');
			} else {
				$('body').removeClass('has-footer-background');
				$('.site-footer').removeClass('has-background');
			}
		});
	});
	wp.customize('social_icon_color', value => {
		value.bind(to => {
			const hsl = Object(_util__WEBPACK_IMPORTED_MODULE_0__["hexToHSL"])(to);
			const setTo = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : undefined;
			document.querySelector(':root').style.setProperty('--go-social--color--text', setTo);
		});
	});
	wp.customize('footer_widgets_text_color', value => {
		value.bind(to => {
			const hsl = Object(_util__WEBPACK_IMPORTED_MODULE_0__["hexToHSL"])(to);
			const setTo = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : undefined;
			document.querySelector(':root').style.setProperty('--gf-footer-widgets--color--text', setTo);
		});
	});
	wp.customize('footer_widgets_heading_color', value => {
		value.bind(to => {
			const hsl = Object(_util__WEBPACK_IMPORTED_MODULE_0__["hexToHSL"])(to);
			const setTo = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : 'var( --go-heading--color--text )';
			document.querySelector(':root').style.setProperty('--gf-footer-widgets--heading--color--text', setTo);
		});
	});
	wp.customize('footer_widgets_link_form_color', value => {
		value.bind(to => {
			const hsl    = Object(_util__WEBPACK_IMPORTED_MODULE_0__["hexToHSL"])(to);
			const link   = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : 'var( --go--hyperlink--color--text )';
			const button = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : 'var( --go-button--color--background )';
			document.querySelector(':root').style.setProperty('--gf-footer-widgets--hyperlink--color--text', link);
			document.querySelector(':root').style.setProperty('--gf-footer-widgets--button--color--background', button);
		});
	});
	wp.customize('footer_widgets_interactive_color', value => {
		value.bind(to => {
			const hsl = Object(_util__WEBPACK_IMPORTED_MODULE_0__["hexToHSL"])(to);
			const setTo = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : 'var( --go--color--secondary )';
			document.querySelector(':root').style.setProperty('--gf-footer-widgets--hyperlink-interactive--color--text', setTo);
			document.querySelector(':root').style.setProperty('--gf-footer-widgets--button-interactive--color--background', setTo);
			document.querySelector(':root').style.setProperty('--gf-footer-widgets--input-interactive--color--border-color', setTo);
		});
	});
	wp.customize('footer_text_color', value => {
		value.bind(to => {
			const hsl = Object(_util__WEBPACK_IMPORTED_MODULE_0__["hexToHSL"])(to);
			const setTo = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : undefined;
			document.querySelector(':root').style.setProperty('--go-footer--color--text', setTo);
			document.querySelector(':root').style.setProperty('--go-footer-navigation--color--text', setTo);
		});
	});
	wp.customize('footer_heading_color', value => {
		value.bind(to => {
			const hsl = Object(_util__WEBPACK_IMPORTED_MODULE_0__["hexToHSL"])(to);
			const setTo = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : null;
			document.querySelector(':root').style.setProperty('--go-footer-heading--color--text', setTo);
		});
	});
	wp.customize('social_icon_facebook', value => {
		value.bind(to => {
			if (to) {
				$('.social-icon-facebook').removeClass('display-none');
			} else {
				$('.social-icon-facebook').addClass('display-none');
			}
		});
	});
	wp.customize('social_icon_twitter', value => {
		value.bind(to => {
			if (to) {
				$('.social-icon-twitter').removeClass('display-none');
			} else {
				$('.social-icon-twitter').addClass('display-none');
			}
		});
	});
	wp.customize('social_icon_instagram', value => {
		value.bind(to => {
			if (to) {
				$('.social-icon-instagram').removeClass('display-none');
			} else {
				$('.social-icon-instagram').addClass('display-none');
			}
		});
	});
	wp.customize('social_icon_linkedin', value => {
		value.bind(to => {
			if (to) {
				$('.social-icon-linkedin').removeClass('display-none');
			} else {
				$('.social-icon-linkedin').addClass('display-none');
			}
		});
	});
	wp.customize('social_icon_xing', function (value) {
		value.bind(function (to) {
			if (to) {
				$('.social-icon-xing').removeClass('display-none');
			} else {
				$('.social-icon-xing').addClass('display-none');
			}
		});
	});
	wp.customize('social_icon_pinterest', value => {
		value.bind(to => {
			if (to) {
				$('.social-icon-pinterest').removeClass('display-none');
			} else {
				$('.social-icon-pinterest').addClass('display-none');
			}
		});
	});
	wp.customize('social_icon_youtube', value => {
		value.bind(to => {
			if (to) {
				$('.social-icon-youtube').removeClass('display-none');
			} else {
				$('.social-icon-youtube').addClass('display-none');
			}
		});
	});
	wp.customize('social_icon_spotify', value => {
		value.bind(to => {
			if (to) {
				$('.social-icon-spotify').removeClass('display-none');
			} else {
				$('.social-icon-spotify').addClass('display-none');
			}
		});
	});
	wp.customize('social_icon_github', value => {
		value.bind(to => {
			if (to) {
				$('.social-icon-github').removeClass('display-none');
			} else {
				$('.social-icon-github').addClass('display-none');
			}
		});
	});
	wp.customize('social_icon_codepen', value => {
		value.bind(to => {
			if (to) {
				$('.social-icon-codepen').removeClass('display-none');
			} else {
				$('.social-icon-codepen').addClass('display-none');
			}
		});
	});

	// Hide footer social icons if box is not checked.
	wp.customize( 'gf_display_social', value => {
		value.bind( to => {
			if (to) {
				$( '.site-footer .social-icons' ).removeClass( 'display-none' );
			} else {
				$( '.site-footer .social-icons' ).addClass( 'display-none' );
			}
		});
	});
});

function setMenuLocationDescription() {
  var menuLocationsDescription = $('.customize-section-title-menu_locations-description').text(),
	  menuLocationCount = ['footer-1', 'footer-2'].includes(wp.customize('footer_variation').get()) ? '2' : '4';
  $('.customize-section-title-menu_locations-description').text(menuLocationsDescription.replace(/[0-9]/g, menuLocationCount));
}

/***/ }),

/***/ "./.dev/assets/admin/js/customize/preview/header.js":
/*!**********************************************************!*\
  !*** ./.dev/assets/admin/js/customize/preview/header.js ***!
  \**********************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony import */ var _util__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ../util */ "./.dev/assets/admin/js/customize/util.js");

const $ = jQuery; // eslint-disable-line

/* harmony default export */ __webpack_exports__["default"] = (() => {
  wp.customize('header_variation', value => {
	value.bind(to => {
	  $('body').removeClass('has-header-1 has-header-2 has-header-3 has-header-4 has-header-5 has-header-6 has-header-7').addClass('has-' + to);
	});
  });
  wp.customize('header_background_color', value => {
	value.bind(to => {
	  const hsl = Object(_util__WEBPACK_IMPORTED_MODULE_0__["hexToHSL"])(to);
	  const setTo = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : undefined;
	  document.querySelector(':root').style.setProperty('--go-header--color--background', setTo); // Add class if a background color is applied.

	  if (to) {
		$('.header').addClass('has-background');
	  } else {
		$('.header').removeClass('has-background');
	  }
	});
  });
  wp.customize('header_text_color', value => {
	value.bind(to => {
	  const hsl = Object(_util__WEBPACK_IMPORTED_MODULE_0__["hexToHSL"])(to);
	  const setTo = to ? `hsl(${hsl[0]}, ${hsl[1]}%, ${hsl[2]}%)` : undefined;
	  document.querySelector(':root').style.setProperty('--go-navigation--color--text', setTo);
	  document.querySelector(':root').style.setProperty('--go-site-description--color--text', setTo);
	  document.querySelector(':root').style.setProperty('--go-search-button--color--text', setTo);
	  document.querySelector(':root').style.setProperty('--go-site-title--color--text', setTo);
	});
  });
});

/***/ }),

/***/ "./.dev/assets/admin/js/customize/preview/logo-sizing.js":
/*!***************************************************************!*\
  !*** ./.dev/assets/admin/js/customize/preview/logo-sizing.js ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony default export */ __webpack_exports__["default"] = (() => {
  /**
   * Set Logo width.
   *
   * @param {*} width
   */
  const setLogoWidth = width => {
	document.documentElement.style.setProperty('--go-logo--max-width', width ? `${width}px` : 'none');
  };
  /**
   * Set Logo mobile width.
   *
   * @param {*} width
   */


  const setLogoMobileWidth = width => {
	document.documentElement.style.setProperty('--go-logo-mobile--max-width', width ? `${width}px` : 'none');
  };

  wp.customize('logo_width', value => {
	value.bind(to => setLogoWidth(to));
  });
  wp.customize('logo_width_mobile', value => {
	value.bind(to => setLogoMobileWidth(to));
  });
});

/***/ }),

/***/ "./.dev/assets/admin/js/customize/preview/page-titles.js":
/*!***************************************************************!*\
  !*** ./.dev/assets/admin/js/customize/preview/page-titles.js ***!
  \***************************************************************/
/*! exports provided: default */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
const $ = jQuery; // eslint-disable-line

/* harmony default export */ __webpack_exports__["default"] = (() => {
  wp.customize('page_titles', value => {
	const selectors = '#content > .entry-header, body.page article .entry-header, body.woocommerce .entry-header';
	value.bind(to => {
	  if (to) {
		$('body').addClass('has-page-titles');
		$(selectors).removeClass('display-none');
	  } else {
		$('body').removeClass('has-page-titles');
		$(selectors).addClass('display-none');
	  }
	});
  });
});

/***/ }),

/***/ "./.dev/assets/admin/js/customize/util.js":
/*!************************************************!*\
  !*** ./.dev/assets/admin/js/customize/util.js ***!
  \************************************************/
/*! exports provided: hexToHSL */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
__webpack_require__.r(__webpack_exports__);
/* harmony export (binding) */ __webpack_require__.d(__webpack_exports__, "hexToHSL", function() { return hexToHSL; });
/**
 * Functions to convert hex color to HSL
 * @param {*} H
 */
function hexToHSL(H) {
  // Convert hex to RGB first
  let r = 0,
	  g = 0,
	  b = 0;

  if (4 == H.length) {
	r = `0x${H[1]}${H[1]}`;
	g = `0x${H[2]}${H[2]}`;
	b = `0x${H[3]}${H[3]}`;
  } else if (7 == H.length) {
	r = `0x${H[1]}${H[2]}`;
	g = `0x${H[3]}${H[4]}`;
	b = `0x${H[5]}${H[6]}`;
  } // Then to HSL


  r /= 255;
  g /= 255;
  b /= 255;
  const cmin = Math.min(r, g, b),
		cmax = Math.max(r, g, b),
		delta = cmax - cmin;
  let h = 0;
  let s = 0;
  let l = 0;
  if (0 == delta) h = 0;else if (cmax == r) h = (g - b) / delta % 6;else if (cmax == g) h = (b - r) / delta + 2;else h = (r - g) / delta + 4;
  h = Math.round(h * 60);
  if (0 > h) h += 360;
  l = (cmax + cmin) / 2;
  s = 0 == delta ? 0 : delta / (1 - Math.abs(2 * l - 1));
  s = +(s * 100).toFixed();
  l = +(l * 100).toFixed();
  return [h, s, l];
}

/***/ })

/******/ });
//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJmaWxlIjoianMvYWRtaW4vY3VzdG9taXplLXByZXZpZXcuanMiLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vd2VicGFjay9ib290c3RyYXAiLCJ3ZWJwYWNrOi8vLy4vLmRldi9hc3NldHMvYWRtaW4vanMvY3VzdG9taXplLXByZXZpZXcuanMiLCJ3ZWJwYWNrOi8vLy4vLmRldi9hc3NldHMvYWRtaW4vanMvY3VzdG9taXplL3ByZXZpZXcvY29sb3Itc2NoZW1lcy5qcyIsIndlYnBhY2s6Ly8vLi8uZGV2L2Fzc2V0cy9hZG1pbi9qcy9jdXN0b21pemUvcHJldmlldy9kZXNpZ24tc3R5bGUuanMiLCJ3ZWJwYWNrOi8vLy4vLmRldi9hc3NldHMvYWRtaW4vanMvY3VzdG9taXplL3ByZXZpZXcvZm9vdGVyLmpzIiwid2VicGFjazovLy8uLy5kZXYvYXNzZXRzL2FkbWluL2pzL2N1c3RvbWl6ZS9wcmV2aWV3L2hlYWRlci5qcyIsIndlYnBhY2s6Ly8vLi8uZGV2L2Fzc2V0cy9hZG1pbi9qcy9jdXN0b21pemUvcHJldmlldy9sb2dvLXNpemluZy5qcyIsIndlYnBhY2s6Ly8vLi8uZGV2L2Fzc2V0cy9hZG1pbi9qcy9jdXN0b21pemUvcHJldmlldy9wYWdlLXRpdGxlcy5qcyIsIndlYnBhY2s6Ly8vLi8uZGV2L2Fzc2V0cy9hZG1pbi9qcy9jdXN0b21pemUvdXRpbC5qcyJdLCJzb3VyY2VzQ29udGVudCI6WyIgXHQvLyBUaGUgbW9kdWxlIGNhY2hlXG4gXHR2YXIgaW5zdGFsbGVkTW9kdWxlcyA9IHt9O1xuXG4gXHQvLyBUaGUgcmVxdWlyZSBmdW5jdGlvblxuIFx0ZnVuY3Rpb24gX193ZWJwYWNrX3JlcXVpcmVfXyhtb2R1bGVJZCkge1xuXG4gXHRcdC8vIENoZWNrIGlmIG1vZHVsZSBpcyBpbiBjYWNoZVxuIFx0XHRpZihpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSkge1xuIFx0XHRcdHJldHVybiBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXS5leHBvcnRzO1xuIFx0XHR9XG4gXHRcdC8vIENyZWF0ZSBhIG5ldyBtb2R1bGUgKGFuZCBwdXQgaXQgaW50byB0aGUgY2FjaGUpXG4gXHRcdHZhciBtb2R1bGUgPSBpbnN0YWxsZWRNb2R1bGVzW21vZHVsZUlkXSA9IHtcbiBcdFx0XHRpOiBtb2R1bGVJZCxcbiBcdFx0XHRsOiBmYWxzZSxcbiBcdFx0XHRleHBvcnRzOiB7fVxuIFx0XHR9O1xuXG4gXHRcdC8vIEV4ZWN1dGUgdGhlIG1vZHVsZSBmdW5jdGlvblxuIFx0XHRtb2R1bGVzW21vZHVsZUlkXS5jYWxsKG1vZHVsZS5leHBvcnRzLCBtb2R1bGUsIG1vZHVsZS5leHBvcnRzLCBfX3dlYnBhY2tfcmVxdWlyZV9fKTtcblxuIFx0XHQvLyBGbGFnIHRoZSBtb2R1bGUgYXMgbG9hZGVkXG4gXHRcdG1vZHVsZS5sID0gdHJ1ZTtcblxuIFx0XHQvLyBSZXR1cm4gdGhlIGV4cG9ydHMgb2YgdGhlIG1vZHVsZVxuIFx0XHRyZXR1cm4gbW9kdWxlLmV4cG9ydHM7XG4gXHR9XG5cblxuIFx0Ly8gZXhwb3NlIHRoZSBtb2R1bGVzIG9iamVjdCAoX193ZWJwYWNrX21vZHVsZXNfXylcbiBcdF9fd2VicGFja19yZXF1aXJlX18ubSA9IG1vZHVsZXM7XG5cbiBcdC8vIGV4cG9zZSB0aGUgbW9kdWxlIGNhY2hlXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLmMgPSBpbnN0YWxsZWRNb2R1bGVzO1xuXG4gXHQvLyBkZWZpbmUgZ2V0dGVyIGZ1bmN0aW9uIGZvciBoYXJtb255IGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uZCA9IGZ1bmN0aW9uKGV4cG9ydHMsIG5hbWUsIGdldHRlcikge1xuIFx0XHRpZighX193ZWJwYWNrX3JlcXVpcmVfXy5vKGV4cG9ydHMsIG5hbWUpKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIG5hbWUsIHsgZW51bWVyYWJsZTogdHJ1ZSwgZ2V0OiBnZXR0ZXIgfSk7XG4gXHRcdH1cbiBcdH07XG5cbiBcdC8vIGRlZmluZSBfX2VzTW9kdWxlIG9uIGV4cG9ydHNcbiBcdF9fd2VicGFja19yZXF1aXJlX18uciA9IGZ1bmN0aW9uKGV4cG9ydHMpIHtcbiBcdFx0aWYodHlwZW9mIFN5bWJvbCAhPT0gJ3VuZGVmaW5lZCcgJiYgU3ltYm9sLnRvU3RyaW5nVGFnKSB7XG4gXHRcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsIFN5bWJvbC50b1N0cmluZ1RhZywgeyB2YWx1ZTogJ01vZHVsZScgfSk7XG4gXHRcdH1cbiBcdFx0T2JqZWN0LmRlZmluZVByb3BlcnR5KGV4cG9ydHMsICdfX2VzTW9kdWxlJywgeyB2YWx1ZTogdHJ1ZSB9KTtcbiBcdH07XG5cbiBcdC8vIGNyZWF0ZSBhIGZha2UgbmFtZXNwYWNlIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDE6IHZhbHVlIGlzIGEgbW9kdWxlIGlkLCByZXF1aXJlIGl0XG4gXHQvLyBtb2RlICYgMjogbWVyZ2UgYWxsIHByb3BlcnRpZXMgb2YgdmFsdWUgaW50byB0aGUgbnNcbiBcdC8vIG1vZGUgJiA0OiByZXR1cm4gdmFsdWUgd2hlbiBhbHJlYWR5IG5zIG9iamVjdFxuIFx0Ly8gbW9kZSAmIDh8MTogYmVoYXZlIGxpa2UgcmVxdWlyZVxuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy50ID0gZnVuY3Rpb24odmFsdWUsIG1vZGUpIHtcbiBcdFx0aWYobW9kZSAmIDEpIHZhbHVlID0gX193ZWJwYWNrX3JlcXVpcmVfXyh2YWx1ZSk7XG4gXHRcdGlmKG1vZGUgJiA4KSByZXR1cm4gdmFsdWU7XG4gXHRcdGlmKChtb2RlICYgNCkgJiYgdHlwZW9mIHZhbHVlID09PSAnb2JqZWN0JyAmJiB2YWx1ZSAmJiB2YWx1ZS5fX2VzTW9kdWxlKSByZXR1cm4gdmFsdWU7XG4gXHRcdHZhciBucyA9IE9iamVjdC5jcmVhdGUobnVsbCk7XG4gXHRcdF9fd2VicGFja19yZXF1aXJlX18ucihucyk7XG4gXHRcdE9iamVjdC5kZWZpbmVQcm9wZXJ0eShucywgJ2RlZmF1bHQnLCB7IGVudW1lcmFibGU6IHRydWUsIHZhbHVlOiB2YWx1ZSB9KTtcbiBcdFx0aWYobW9kZSAmIDIgJiYgdHlwZW9mIHZhbHVlICE9ICdzdHJpbmcnKSBmb3IodmFyIGtleSBpbiB2YWx1ZSkgX193ZWJwYWNrX3JlcXVpcmVfXy5kKG5zLCBrZXksIGZ1bmN0aW9uKGtleSkgeyByZXR1cm4gdmFsdWVba2V5XTsgfS5iaW5kKG51bGwsIGtleSkpO1xuIFx0XHRyZXR1cm4gbnM7XG4gXHR9O1xuXG4gXHQvLyBnZXREZWZhdWx0RXhwb3J0IGZ1bmN0aW9uIGZvciBjb21wYXRpYmlsaXR5IHdpdGggbm9uLWhhcm1vbnkgbW9kdWxlc1xuIFx0X193ZWJwYWNrX3JlcXVpcmVfXy5uID0gZnVuY3Rpb24obW9kdWxlKSB7XG4gXHRcdHZhciBnZXR0ZXIgPSBtb2R1bGUgJiYgbW9kdWxlLl9fZXNNb2R1bGUgP1xuIFx0XHRcdGZ1bmN0aW9uIGdldERlZmF1bHQoKSB7IHJldHVybiBtb2R1bGVbJ2RlZmF1bHQnXTsgfSA6XG4gXHRcdFx0ZnVuY3Rpb24gZ2V0TW9kdWxlRXhwb3J0cygpIHsgcmV0dXJuIG1vZHVsZTsgfTtcbiBcdFx0X193ZWJwYWNrX3JlcXVpcmVfXy5kKGdldHRlciwgJ2EnLCBnZXR0ZXIpO1xuIFx0XHRyZXR1cm4gZ2V0dGVyO1xuIFx0fTtcblxuIFx0Ly8gT2JqZWN0LnByb3RvdHlwZS5oYXNPd25Qcm9wZXJ0eS5jYWxsXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLm8gPSBmdW5jdGlvbihvYmplY3QsIHByb3BlcnR5KSB7IHJldHVybiBPYmplY3QucHJvdG90eXBlLmhhc093blByb3BlcnR5LmNhbGwob2JqZWN0LCBwcm9wZXJ0eSk7IH07XG5cbiBcdC8vIF9fd2VicGFja19wdWJsaWNfcGF0aF9fXG4gXHRfX3dlYnBhY2tfcmVxdWlyZV9fLnAgPSBcIlwiO1xuXG5cbiBcdC8vIExvYWQgZW50cnkgbW9kdWxlIGFuZCByZXR1cm4gZXhwb3J0c1xuIFx0cmV0dXJuIF9fd2VicGFja19yZXF1aXJlX18oX193ZWJwYWNrX3JlcXVpcmVfXy5zID0gXCIuLy5kZXYvYXNzZXRzL2FkbWluL2pzL2N1c3RvbWl6ZS1wcmV2aWV3LmpzXCIpO1xuIiwiaW1wb3J0IERlc2lnblN0eWxlUHJldmlldyBmcm9tICcuL2N1c3RvbWl6ZS9wcmV2aWV3L2Rlc2lnbi1zdHlsZSc7XG5pbXBvcnQgSGVhZGVyQ29sb3JzUHJldmlldyBmcm9tICcuL2N1c3RvbWl6ZS9wcmV2aWV3L2hlYWRlcic7XG5pbXBvcnQgRm9vdGVyQ29sb3JzUHJldmlldyBmcm9tICcuL2N1c3RvbWl6ZS9wcmV2aWV3L2Zvb3Rlcic7XG5pbXBvcnQgQ29sb3JTY2hlbWVQcmV2aWV3IGZyb20gJy4vY3VzdG9taXplL3ByZXZpZXcvY29sb3Itc2NoZW1lcyc7XG5pbXBvcnQgTG9nb1NpemluZ1ByZXZpZXcgZnJvbSAnLi9jdXN0b21pemUvcHJldmlldy9sb2dvLXNpemluZyc7XG5pbXBvcnQgUGFnZVRpdGxlc1ByZXZpZXcgZnJvbSAnLi9jdXN0b21pemUvcHJldmlldy9wYWdlLXRpdGxlcyc7XG5cbkRlc2lnblN0eWxlUHJldmlldygpO1xuSGVhZGVyQ29sb3JzUHJldmlldygpO1xuRm9vdGVyQ29sb3JzUHJldmlldygpO1xuQ29sb3JTY2hlbWVQcmV2aWV3KCk7XG5Mb2dvU2l6aW5nUHJldmlldygpO1xuUGFnZVRpdGxlc1ByZXZpZXcoKTtcbiIsImltcG9ydCB7IGhleFRvSFNMIH0gZnJvbSAnLi4vdXRpbCc7XG5cbmNvbnN0ICQgPSBqUXVlcnk7IC8vIGVzbGludC1kaXNhYmxlLWxpbmVcblxuZXhwb3J0IGRlZmF1bHQgKCkgPT4ge1xuXHRsZXQgc2VsZWN0ZWREZXNpZ25TdHlsZSA9IEdvUHJldmlld0RhdGEuc2VsZWN0ZWREZXNpZ25TdHlsZTtcblxuXHQvKipcblx0ICogU2V0IGNvbG9yXG5cdCAqXG5cdCAqIEBwYXJhbSB7Kn0gY29sb3Jcblx0ICovXG5cdGNvbnN0IHNldENvbG9yID0gKCBjb2xvciwgY3NzVmFyICkgPT4ge1xuXHRcdGNvbnN0IGhzbCA9IGhleFRvSFNMKCBjb2xvciApO1xuXHRcdGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoICc6cm9vdCcgKS5zdHlsZS5zZXRQcm9wZXJ0eSggYCR7Y3NzVmFyfWAsIGBoc2woJHtoc2xbIDAgXX0sICR7aHNsWyAxIF19JSwgJHtoc2xbIDIgXX0lKWAgKTtcblx0fTtcblxuXHQvKipcblx0ICogTG9hZCB0aGUgY29sb3Igc2NoZW1lcyBmb3IgdGhlIHNlbGVjdGVkIGRlc2lnbiBzdHlsZS5cblx0ICovXG5cdGNvbnN0IGxvYWRDb2xvclNjaGVtZXMgPSAoIGNvbG9yU2NoZW1lICkgPT4ge1xuXHRcdGNvbnN0IGRlc2lnblN0eWxlID0gZ2V0RGVzaWduU3R5bGUoIHNlbGVjdGVkRGVzaWduU3R5bGUgKTtcblx0XHRjb2xvclNjaGVtZSA9IGNvbG9yU2NoZW1lLnJlcGxhY2UoIGAke3NlbGVjdGVkRGVzaWduU3R5bGV9LWAsICcnICk7XG5cblx0XHRpZiAoICd1bmRlZmluZWQnICE9PSB0eXBlb2YgZGVzaWduU3R5bGUuY29sb3Jfc2NoZW1lc1sgY29sb3JTY2hlbWUgXSAmJiAndW5kZWZpbmVkJyAhPT0gdHlwZW9mIHdwLmN1c3RvbWl6ZS5zZXR0aW5ncy5jb250cm9scyApIHtcblx0XHRcdGNvbnN0IGNvbG9ycyA9IGRlc2lnblN0eWxlLmNvbG9yX3NjaGVtZXNbIGNvbG9yU2NoZW1lIF07XG5cdFx0XHR0b2dnbGVDb2xvclNjaGVtZXMoKTtcblxuXHRcdFx0c2V0VGltZW91dCggZnVuY3Rpb24oKSB7XG5cdFx0XHRcdHVwZGF0ZVZpZXdwb3J0QmFzaXMoIGRlc2lnblN0eWxlICk7XG5cdFx0XHR9LCAyMDAgKTtcblxuXHRcdFx0T2JqZWN0LmVudHJpZXMoIHdwLmN1c3RvbWl6ZS5zZXR0aW5ncy5jb250cm9scyApXG5cdFx0XHRcdC5maWx0ZXIoICggWyBfY29udHJvbCwgY29uZmlnIF0gKSA9PiBjb25maWcudHlwZSA9PT0gJ2NvbG9yJyApXG5cdFx0XHRcdC5mb3JFYWNoKCAoIFsgY3VzdG9taXplckNvbnRyb2wsIGNvbmZpZyBdICkgPT4ge1xuXHRcdFx0XHRcdGNvbnN0IGN1c3RvbWl6ZXJTZXR0aW5nID0gd3AuY3VzdG9taXplKCBjb25maWcuc2V0dGluZ3MuZGVmYXVsdCApO1xuXHRcdFx0XHRcdGNvbnN0IGNvbG9yID0gY29sb3JzWyBjb25maWcuc2V0dGluZ3MuZGVmYXVsdC5yZXBsYWNlKCAnX2NvbG9yJywgJycgKSBdIHx8ICcnO1xuXG5cdFx0XHRcdFx0Y3VzdG9taXplclNldHRpbmcuc2V0KCBjb2xvciApO1xuXG5cdFx0XHRcdFx0d3AuY3VzdG9taXplLmNvbnRyb2woIGN1c3RvbWl6ZXJDb250cm9sICkuY29udGFpbmVyLmZpbmQoICcuY29sb3ItcGlja2VyLWhleCcgKVxuXHRcdFx0XHRcdFx0LmRhdGEoICdkYXRhLWRlZmF1bHQtY29sb3InLCBjb2xvciApXG5cdFx0XHRcdFx0XHQud3BDb2xvclBpY2tlciggJ2RlZmF1bHRDb2xvcicsIGNvbG9yIClcblx0XHRcdFx0XHRcdC50cmlnZ2VyKCAnY2hhbmdlJyApO1xuXHRcdFx0XHR9ICk7XG5cdFx0fVxuXHR9O1xuXG5cdC8qKlxuXHQgKiBDb250cm9sIHRoZSB2aXNpYmlsaXR5IG9mIHRoZSBjb2xvciBzY2hlbWVzIHNlbGVjdGlvbnMuXG5cdCAqL1xuXHRjb25zdCB0b2dnbGVDb2xvclNjaGVtZXMgPSAoKSA9PiB7XG5cdFx0JCggJ2xhYmVsW2Zvcl49Y29sb3Jfc2NoZW1lX2NvbnRyb2xdJyApLmhpZGUoKTtcblx0XHQkKCBgbGFiZWxbZm9yXj1jb2xvcl9zY2hlbWVfY29udHJvbC0ke3NlbGVjdGVkRGVzaWduU3R5bGV9LV1gICkuc2hvdygpO1xuXHR9O1xuXG5cdC8qKlxuXHQgKiBVcGRhdGUgdGhlIHZpZXdwb3J0IGJhc2lzIGZvciB0aGUgc2VsZWN0ZWQgZGVzaWduIHN0eWxlLlxuXHQgKi9cblx0Y29uc3QgdXBkYXRlVmlld3BvcnRCYXNpcyA9ICggZGVzaWduU3R5bGUgKSA9PiB7XG5cdFx0bGV0IHZpZXdwb3J0QmFzaXMgPSAoICd1bmRlZmluZWQnIT09IHR5cGVvZiBkZXNpZ25TdHlsZS52aWV3cG9ydF9iYXNpcyApID8gZGVzaWduU3R5bGUudmlld3BvcnRfYmFzaXMgOiAnOTUwJztcblx0XHR3cC5jdXN0b21pemUuY29udHJvbCggJ3ZpZXdwb3J0X2Jhc2lzJyApLnNldHRpbmcoIHZpZXdwb3J0QmFzaXMgKTtcblx0fTtcblxuXHQvKipcblx0ICogUmV0dXJucyB0aGUgZGVzaWduIHN0eWxlIGFycmF5XG5cdCAqXG5cdCAqIEBwYXJhbSB7Kn0gZGVzaWduU3R5bGVcblx0ICovXG5cdGNvbnN0IGdldERlc2lnblN0eWxlID0gKCBkZXNpZ25TdHlsZSApID0+IHtcblx0XHRpZiAoXG5cdFx0XHQndW5kZWZpbmVkJyAhPT0gdHlwZW9mIEdvUHJldmlld0RhdGFbJ2Rlc2lnbl9zdHlsZXMnXSAmJlxuXHRcdFx0J3VuZGVmaW5lZCcgIT09IEdvUHJldmlld0RhdGFbJ2Rlc2lnbl9zdHlsZXMnXVsgZGVzaWduU3R5bGUgXVxuXHRcdCkge1xuXHRcdFx0cmV0dXJuIEdvUHJldmlld0RhdGFbJ2Rlc2lnbl9zdHlsZXMnXVsgZGVzaWduU3R5bGUgXTtcblx0XHR9XG5cblx0XHRyZXR1cm4gZmFsc2U7XG5cdH07XG5cblx0d3AuY3VzdG9taXplLmJpbmQoICdyZWFkeScsICgpID0+IHRvZ2dsZUNvbG9yU2NoZW1lcygpICk7XG5cblx0d3AuY3VzdG9taXplKCAnZGVzaWduX3N0eWxlJywgKCB2YWx1ZSApID0+IHtcblx0XHRzZWxlY3RlZERlc2lnblN0eWxlID0gdmFsdWUuZ2V0KCk7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHtcblx0XHRcdHNlbGVjdGVkRGVzaWduU3R5bGUgPSB0bztcblx0XHRcdGxvYWRDb2xvclNjaGVtZXMoICdvbmUnICk7XG5cdFx0XHQkKCBgI2NvbG9yX3NjaGVtZV9jb250cm9sLSR7c2VsZWN0ZWREZXNpZ25TdHlsZX0tb25lYCApLnByb3AoICdjaGVja2VkJywgdHJ1ZSApO1xuXHRcdH0gKTtcblx0fSApO1xuXG5cdHdwLmN1c3RvbWl6ZSggJ2NvbG9yX3NjaGVtZScsICggdmFsdWUgKSA9PiB7XG5cdFx0dmFsdWUuYmluZCggKCBjb2xvclNjaGVtZSApID0+IGxvYWRDb2xvclNjaGVtZXMoIGNvbG9yU2NoZW1lICkgKTtcblx0fSApO1xuXG5cdHdwLmN1c3RvbWl6ZSggJ2JhY2tncm91bmRfY29sb3InLCAoIHZhbHVlICkgPT4ge1xuXHRcdHZhbHVlLmJpbmQoICggdG8gKSA9PiBzZXRDb2xvciggdG8sICctLWdvLS1jb2xvci0tYmFja2dyb3VuZCcgKSApO1xuXHR9ICk7XG5cblx0d3AuY3VzdG9taXplKCAncHJpbWFyeV9jb2xvcicsICggdmFsdWUgKSA9PiB7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHNldENvbG9yKCB0bywgJy0tZ28tLWNvbG9yLS1wcmltYXJ5JyApICk7XG5cdH0gKTtcblxuXHR3cC5jdXN0b21pemUoICdzZWNvbmRhcnlfY29sb3InLCAoIHZhbHVlICkgPT4ge1xuXHRcdHZhbHVlLmJpbmQoICggdG8gKSA9PiBzZXRDb2xvciggdG8sICctLWdvLS1jb2xvci0tc2Vjb25kYXJ5JyApICk7XG5cdH0gKTtcblxuXHR3cC5jdXN0b21pemUoICd0ZXJ0aWFyeV9jb2xvcicsICggdmFsdWUgKSA9PiB7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHNldENvbG9yKCB0bywgJy0tZ28tLWNvbG9yLS10ZXJ0aWFyeScgKSApO1xuXHR9ICk7XG59O1xuIiwiY29uc3QgJCA9IGpRdWVyeTsgLy8gZXNsaW50LWRpc2FibGUtbGluZVxuXG5leHBvcnQgZGVmYXVsdCAoKSA9PiB7XG5cdHdwLmN1c3RvbWl6ZSggJ2Rlc2lnbl9zdHlsZScsICggdmFsdWUgKSA9PiB7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHtcblxuXHRcdFx0JCggJyNjdXN0b21pemUtcHJldmlldycgKS5hZGRDbGFzcyggJ2lzLWxvYWRpbmcnICk7XG5cblx0XHRcdGlmIChcblx0XHRcdFx0J3VuZGVmaW5lZCcgIT09IHR5cGVvZiBHb1ByZXZpZXdEYXRhWydkZXNpZ25fc3R5bGVzJ10gJiZcblx0XHRcdFx0J3VuZGVmaW5lZCcgIT09IEdvUHJldmlld0RhdGFbJ2Rlc2lnbl9zdHlsZXMnXVsgdG8gXVxuXHRcdFx0KSB7XG5cblx0XHRcdFx0c2V0VGltZW91dCggZnVuY3Rpb24oKSB7XG5cdFx0XHRcdFx0Y29uc3QgZGVzaWduU3R5bGUgPSBHb1ByZXZpZXdEYXRhWydkZXNpZ25fc3R5bGVzJ11bIHRvIF07XG5cdFx0XHRcdFx0JCggJ2xpbmtbaWQqPVwiZGVzaWduLXN0eWxlXCJdJyApLmF0dHIoICdocmVmJywgZGVzaWduU3R5bGVbJ3VybCddICk7XG5cblx0XHRcdFx0XHRzZXRUaW1lb3V0KCBmdW5jdGlvbigpIHtcblx0XHRcdFx0XHRcdCQoICcjY3VzdG9taXplLXByZXZpZXcnICkucmVtb3ZlQ2xhc3MoICdpcy1sb2FkaW5nJyApO1xuXHRcdFx0XHRcdH0sIDUwMCApO1xuXHRcdFx0XHR9LCA1MDAgKTsgLy8gbWF0Y2ggdGhlIC4wMnMgdHJhbnNpdGlvbiB0aW1lIGZyb20gY29yZVxuXHRcdFx0fVxuXHRcdH0gKTtcblx0fSApO1xuXHQvKipcblx0ICogU2V0IHZpZXdwb3J0IGJhc2lzXG5cdCAqXG5cdCAqIEBwYXJhbSB7Kn0gc2l6ZVxuXHQgKi9cblx0Y29uc3Qgc2V0Vmlld3BvcnRCYXNpcyA9ICggc2l6ZSApID0+IHtcblx0XHRkb2N1bWVudC5kb2N1bWVudEVsZW1lbnQuc3R5bGUuc2V0UHJvcGVydHkoICctLWdvLS12aWV3cG9ydC1iYXNpcycsIHNpemUgPyBzaXplIDogJzEwMDAnICk7XG5cdH07XG5cblx0d3AuY3VzdG9taXplKCAndmlld3BvcnRfYmFzaXMnLCAoIHZhbHVlICkgPT4ge1xuXHRcdHZhbHVlLmJpbmQoICggdG8gKSA9PiBzZXRWaWV3cG9ydEJhc2lzKCB0byApICk7XG5cdH0gKTtcbn07XG4iLCJpbXBvcnQgeyBoZXhUb0hTTCB9IGZyb20gJy4uL3V0aWwnO1xuXG5jb25zdCAkID0galF1ZXJ5OyAvLyBlc2xpbnQtZGlzYWJsZS1saW5lXG5cbiQoIGRvY3VtZW50ICkucmVhZHkoIHNldE1lbnVMb2NhdGlvbkRlc2NyaXB0aW9uICk7XG5cbmV4cG9ydCBkZWZhdWx0ICgpID0+IHtcblx0d3AuY3VzdG9taXplKCAnZm9vdGVyX3ZhcmlhdGlvbicsICggdmFsdWUgKSA9PiB7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHtcblx0XHRcdCQoICdib2R5JyApLnJlbW92ZUNsYXNzKCAnaGFzLWZvb3Rlci0xIGhhcy1mb290ZXItMiBoYXMtZm9vdGVyLTMgaGFzLWZvb3Rlci00JyApXG5cdFx0XHQgICAgICAgICAgIC5hZGRDbGFzcyggJ2hhcy0nICsgdG8gKTtcblx0XHRcdHNldE1lbnVMb2NhdGlvbkRlc2NyaXB0aW9uKCk7XG5cdFx0fSApO1xuXHR9ICk7XG5cblx0d3AuY3VzdG9taXplKCAnY29weXJpZ2h0JywgZnVuY3Rpb24oIHZhbHVlICkge1xuXHRcdHZhbHVlLmJpbmQoIGZ1bmN0aW9uKCB0byApIHtcblx0XHRcdCQoICcuY29weXJpZ2h0JyApLmh0bWwoIHRvICk7XG5cdFx0fSApO1xuXHR9ICk7XG5cblx0d3AuY3VzdG9taXplKCAnZm9vdGVyX2JhY2tncm91bmRfY29sb3InLCAoIHZhbHVlICkgPT4ge1xuXHRcdHZhbHVlLmJpbmQoICggdG8gKSA9PiB7XG5cdFx0XHRjb25zdCBoc2wgPSBoZXhUb0hTTCggdG8gKTtcblx0XHRcdGNvbnN0IHNldFRvID0gdG8gPyBgaHNsKCR7aHNsWzBdfSwgJHtoc2xbMV19JSwgJHtoc2xbMl19JSlgIDogdW5kZWZpbmVkO1xuXHRcdFx0ZG9jdW1lbnQucXVlcnlTZWxlY3RvciggJzpyb290JyApLnN0eWxlLnNldFByb3BlcnR5KCAnLS1nby1mb290ZXItLWNvbG9yLS1iYWNrZ3JvdW5kJywgc2V0VG8gKTtcblxuXHRcdFx0Ly8gQWRkIGNsYXNzIGlmIGEgYmFja2dyb3VuZCBjb2xvciBpcyBhcHBsaWVkLlxuXHRcdFx0aWYgKCB0byApIHtcblx0XHRcdFx0JCggJ2JvZHknICkuYWRkQ2xhc3MoICdoYXMtZm9vdGVyLWJhY2tncm91bmQnICk7XG5cdFx0XHRcdCQoICcuc2l0ZS1mb290ZXInICkuYWRkQ2xhc3MoICdoYXMtYmFja2dyb3VuZCcgKTtcblx0XHRcdH0gZWxzZSB7XG5cdFx0XHRcdCQoICdib2R5JyApLnJlbW92ZUNsYXNzKCAnaGFzLWZvb3Rlci1iYWNrZ3JvdW5kJyApO1xuXHRcdFx0XHQkKCAnLnNpdGUtZm9vdGVyJyApLnJlbW92ZUNsYXNzKCAnaGFzLWJhY2tncm91bmQnICk7XG5cdFx0XHR9XG5cdFx0fSApO1xuXHR9ICk7XG5cblx0d3AuY3VzdG9taXplKCAnc29jaWFsX2ljb25fY29sb3InLCAoIHZhbHVlICkgPT4ge1xuXHRcdHZhbHVlLmJpbmQoICggdG8gKSA9PiB7XG5cdFx0XHRjb25zdCBoc2wgPSBoZXhUb0hTTCggdG8gKTtcblx0XHRcdGNvbnN0IHNldFRvID0gdG8gPyBgaHNsKCR7aHNsWzBdfSwgJHtoc2xbMV19JSwgJHtoc2xbMl19JSlgIDogdW5kZWZpbmVkO1xuXHRcdFx0ZG9jdW1lbnQucXVlcnlTZWxlY3RvciggJzpyb290JyApLnN0eWxlLnNldFByb3BlcnR5KCAnLS1nby1zb2NpYWwtLWNvbG9yLS10ZXh0Jywgc2V0VG8gKTtcblx0XHR9ICk7XG5cdH0gKTtcblxuXHR3cC5jdXN0b21pemUoICdmb290ZXJfdGV4dF9jb2xvcicsICggdmFsdWUgKSA9PiB7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHtcblx0XHRcdGNvbnN0IGhzbCA9IGhleFRvSFNMKCB0byApO1xuXHRcdFx0Y29uc3Qgc2V0VG8gPSB0byA/IGBoc2woJHtoc2xbMF19LCAke2hzbFsxXX0lLCAke2hzbFsyXX0lKWAgOiB1bmRlZmluZWQ7XG5cdFx0XHRkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCAnOnJvb3QnICkuc3R5bGUuc2V0UHJvcGVydHkoICctLWdvLWZvb3Rlci0tY29sb3ItLXRleHQnLCBzZXRUbyApO1xuXHRcdFx0ZG9jdW1lbnQucXVlcnlTZWxlY3RvciggJzpyb290JyApLnN0eWxlLnNldFByb3BlcnR5KCAnLS1nby1mb290ZXItbmF2aWdhdGlvbi0tY29sb3ItLXRleHQnLCBzZXRUbyApO1xuXHRcdH0gKTtcblx0fSApO1xuXG5cdHdwLmN1c3RvbWl6ZSggJ2Zvb3Rlcl9oZWFkaW5nX2NvbG9yJywgKCB2YWx1ZSApID0+IHtcblx0XHR2YWx1ZS5iaW5kKCAoIHRvICkgPT4ge1xuXHRcdFx0Y29uc3QgaHNsID0gaGV4VG9IU0woIHRvICk7XG5cdFx0XHRjb25zdCBzZXRUbyA9IHRvID8gYGhzbCgke2hzbFswXX0sICR7aHNsWzFdfSUsICR7aHNsWzJdfSUpYCA6IG51bGw7XG5cdFx0XHRkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCAnOnJvb3QnICkuc3R5bGUuc2V0UHJvcGVydHkoICctLWdvLWZvb3Rlci1oZWFkaW5nLS1jb2xvci0tdGV4dCcsIHNldFRvICk7XG5cdFx0fSApO1xuXHR9ICk7XG5cblx0d3AuY3VzdG9taXplKCAnc29jaWFsX2ljb25fZmFjZWJvb2snLCAoIHZhbHVlICkgPT4ge1xuXHRcdHZhbHVlLmJpbmQoICggdG8gKSA9PiB7XG5cdFx0XHRpZiAoIHRvICkge1xuXHRcdFx0XHQkKCAnLnNvY2lhbC1pY29uLWZhY2Vib29rJyApLnJlbW92ZUNsYXNzKCAnZGlzcGxheS1ub25lJyApO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0JCggJy5zb2NpYWwtaWNvbi1mYWNlYm9vaycgKS5hZGRDbGFzcyggJ2Rpc3BsYXktbm9uZScgKTtcblx0XHRcdH1cblx0XHR9ICk7XG5cdH0gKTtcblxuXHR3cC5jdXN0b21pemUoICdzb2NpYWxfaWNvbl90d2l0dGVyJywgKCB2YWx1ZSApID0+IHtcblx0XHR2YWx1ZS5iaW5kKCAoIHRvICkgPT4ge1xuXHRcdFx0aWYgKCB0byApIHtcblx0XHRcdFx0JCggJy5zb2NpYWwtaWNvbi10d2l0dGVyJyApLnJlbW92ZUNsYXNzKCAnZGlzcGxheS1ub25lJyApO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0JCggJy5zb2NpYWwtaWNvbi10d2l0dGVyJyApLmFkZENsYXNzKCAnZGlzcGxheS1ub25lJyApO1xuXHRcdFx0fVxuXHRcdH0gKTtcblx0fSApO1xuXG5cdHdwLmN1c3RvbWl6ZSggJ3NvY2lhbF9pY29uX2luc3RhZ3JhbScsICggdmFsdWUgKSA9PiB7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHtcblx0XHRcdGlmICggdG8gKSB7XG5cdFx0XHRcdCQoICcuc29jaWFsLWljb24taW5zdGFncmFtJyApLnJlbW92ZUNsYXNzKCAnZGlzcGxheS1ub25lJyApO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0JCggJy5zb2NpYWwtaWNvbi1pbnN0YWdyYW0nICkuYWRkQ2xhc3MoICdkaXNwbGF5LW5vbmUnICk7XG5cdFx0XHR9XG5cdFx0fSApO1xuXHR9ICk7XG5cblx0d3AuY3VzdG9taXplKCAnc29jaWFsX2ljb25fbGlua2VkaW4nLCAoIHZhbHVlICkgPT4ge1xuXHRcdHZhbHVlLmJpbmQoICggdG8gKSA9PiB7XG5cdFx0XHRpZiAoIHRvICkge1xuXHRcdFx0XHQkKCAnLnNvY2lhbC1pY29uLWxpbmtlZGluJyApLnJlbW92ZUNsYXNzKCAnZGlzcGxheS1ub25lJyApO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0JCggJy5zb2NpYWwtaWNvbi1saW5rZWRpbicgKS5hZGRDbGFzcyggJ2Rpc3BsYXktbm9uZScgKTtcblx0XHRcdH1cblx0XHR9ICk7XG5cdH0gKTtcblxuXHR3cC5jdXN0b21pemUoJ3NvY2lhbF9pY29uX3hpbmcnLCBmdW5jdGlvbiAodmFsdWUpIHtcblx0XHR2YWx1ZS5iaW5kKGZ1bmN0aW9uICh0bykge1xuXHRcdFx0aWYgKHRvKSB7XG5cdFx0XHRcdCQoJy5zb2NpYWwtaWNvbi14aW5nJykucmVtb3ZlQ2xhc3MoJ2Rpc3BsYXktbm9uZScpO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0JCgnLnNvY2lhbC1pY29uLXhpbmcnKS5hZGRDbGFzcygnZGlzcGxheS1ub25lJyk7XG5cdFx0XHR9XG5cdFx0fSk7XG5cdH0pO1xuXG5cdHdwLmN1c3RvbWl6ZSggJ3NvY2lhbF9pY29uX3BpbnRlcmVzdCcsICggdmFsdWUgKSA9PiB7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHtcblx0XHRcdGlmICggdG8gKSB7XG5cdFx0XHRcdCQoICcuc29jaWFsLWljb24tcGludGVyZXN0JyApLnJlbW92ZUNsYXNzKCAnZGlzcGxheS1ub25lJyApO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0JCggJy5zb2NpYWwtaWNvbi1waW50ZXJlc3QnICkuYWRkQ2xhc3MoICdkaXNwbGF5LW5vbmUnICk7XG5cdFx0XHR9XG5cdFx0fSApO1xuXHR9ICk7XG5cblx0d3AuY3VzdG9taXplKCAnc29jaWFsX2ljb25feW91dHViZScsICggdmFsdWUgKSA9PiB7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHtcblx0XHRcdGlmICggdG8gKSB7XG5cdFx0XHRcdCQoICcuc29jaWFsLWljb24teW91dHViZScgKS5yZW1vdmVDbGFzcyggJ2Rpc3BsYXktbm9uZScgKTtcblx0XHRcdH0gZWxzZSB7XG5cdFx0XHRcdCQoICcuc29jaWFsLWljb24teW91dHViZScgKS5hZGRDbGFzcyggJ2Rpc3BsYXktbm9uZScgKTtcblx0XHRcdH1cblx0XHR9ICk7XG5cdH0gKTtcblxuXHR3cC5jdXN0b21pemUoICdzb2NpYWxfaWNvbl9zcG90aWZ5JywgKCB2YWx1ZSApID0+IHtcblx0XHR2YWx1ZS5iaW5kKCAoIHRvICkgPT4ge1xuXHRcdFx0aWYgKCB0byApIHtcblx0XHRcdFx0JCggJy5zb2NpYWwtaWNvbi1zcG90aWZ5JyApLnJlbW92ZUNsYXNzKCAnZGlzcGxheS1ub25lJyApO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0JCggJy5zb2NpYWwtaWNvbi1zcG90aWZ5JyApLmFkZENsYXNzKCAnZGlzcGxheS1ub25lJyApO1xuXHRcdFx0fVxuXHRcdH0gKTtcblx0fSApO1xuXG5cdHdwLmN1c3RvbWl6ZSggJ3NvY2lhbF9pY29uX2dpdGh1YicsICggdmFsdWUgKSA9PiB7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHtcblx0XHRcdGlmICggdG8gKSB7XG5cdFx0XHRcdCQoICcuc29jaWFsLWljb24tZ2l0aHViJyApLnJlbW92ZUNsYXNzKCAnZGlzcGxheS1ub25lJyApO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0JCggJy5zb2NpYWwtaWNvbi1naXRodWInICkuYWRkQ2xhc3MoICdkaXNwbGF5LW5vbmUnICk7XG5cdFx0XHR9XG5cdFx0fSApO1xuXHR9ICk7XG59O1xuXG5mdW5jdGlvbiBzZXRNZW51TG9jYXRpb25EZXNjcmlwdGlvbigpIHtcblx0dmFyIG1lbnVMb2NhdGlvbnNEZXNjcmlwdGlvbiA9ICQoICcuY3VzdG9taXplLXNlY3Rpb24tdGl0bGUtbWVudV9sb2NhdGlvbnMtZGVzY3JpcHRpb24nICkudGV4dCgpLFxuXHQgICAgbWVudUxvY2F0aW9uQ291bnQgICAgICAgID0gWyAnZm9vdGVyLTEnLCAnZm9vdGVyLTInIF0uaW5jbHVkZXMoIHdwLmN1c3RvbWl6ZSggJ2Zvb3Rlcl92YXJpYXRpb24nICkuZ2V0KCkgKSA/ICcyJyA6ICc0Jztcblx0JCggJy5jdXN0b21pemUtc2VjdGlvbi10aXRsZS1tZW51X2xvY2F0aW9ucy1kZXNjcmlwdGlvbicgKS50ZXh0KCBtZW51TG9jYXRpb25zRGVzY3JpcHRpb24ucmVwbGFjZSggL1swLTldL2csIG1lbnVMb2NhdGlvbkNvdW50ICkgKTtcbn1cbiIsImltcG9ydCB7IGhleFRvSFNMIH0gZnJvbSAnLi4vdXRpbCc7XG5cbmNvbnN0ICQgPSBqUXVlcnk7IC8vIGVzbGludC1kaXNhYmxlLWxpbmVcblxuZXhwb3J0IGRlZmF1bHQgKCkgPT4ge1xuXHR3cC5jdXN0b21pemUoICdoZWFkZXJfdmFyaWF0aW9uJywgKCB2YWx1ZSApID0+IHtcblx0XHR2YWx1ZS5iaW5kKCAoIHRvICkgPT4ge1xuXHRcdFx0JCggJ2JvZHknICkucmVtb3ZlQ2xhc3MoICdoYXMtaGVhZGVyLTEgaGFzLWhlYWRlci0yIGhhcy1oZWFkZXItMyBoYXMtaGVhZGVyLTQgaGFzLWhlYWRlci01IGhhcy1oZWFkZXItNiBoYXMtaGVhZGVyLTcnIClcblx0XHRcdCAgICAgICAgICAgLmFkZENsYXNzKCAnaGFzLScgKyB0byApO1xuXHRcdH0gKTtcblx0fSApO1xuXG5cdHdwLmN1c3RvbWl6ZSggJ2hlYWRlcl9iYWNrZ3JvdW5kX2NvbG9yJywgKCB2YWx1ZSApID0+IHtcblx0XHR2YWx1ZS5iaW5kKCAoIHRvICkgPT4ge1xuXHRcdFx0Y29uc3QgaHNsID0gaGV4VG9IU0woIHRvICk7XG5cdFx0XHRjb25zdCBzZXRUbyA9IHRvID8gYGhzbCgke2hzbFswXX0sICR7aHNsWzFdfSUsICR7aHNsWzJdfSUpYCA6IHVuZGVmaW5lZCA7XG5cdFx0XHRkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCAnOnJvb3QnICkuc3R5bGUuc2V0UHJvcGVydHkoICctLWdvLWhlYWRlci0tY29sb3ItLWJhY2tncm91bmQnLCBzZXRUbyApO1xuXG5cdFx0XHQvLyBBZGQgY2xhc3MgaWYgYSBiYWNrZ3JvdW5kIGNvbG9yIGlzIGFwcGxpZWQuXG5cdFx0XHRpZiAoIHRvICkge1xuXHRcdFx0XHQkKCAnLmhlYWRlcicgKS5hZGRDbGFzcyggJ2hhcy1iYWNrZ3JvdW5kJyApO1xuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0JCggJy5oZWFkZXInICkucmVtb3ZlQ2xhc3MoICdoYXMtYmFja2dyb3VuZCcgKTtcblx0XHRcdH1cblx0XHR9ICk7XG5cdH0gKTtcblxuXHR3cC5jdXN0b21pemUoICdoZWFkZXJfdGV4dF9jb2xvcicsICggdmFsdWUgKSA9PiB7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHtcblx0XHRcdGNvbnN0IGhzbCA9IGhleFRvSFNMKCB0byApO1xuXHRcdFx0Y29uc3Qgc2V0VG8gPSB0byA/IGBoc2woJHtoc2xbMF19LCAke2hzbFsxXX0lLCAke2hzbFsyXX0lKWAgOiB1bmRlZmluZWQgO1xuXHRcdFx0ZG9jdW1lbnQucXVlcnlTZWxlY3RvciggJzpyb290JyApLnN0eWxlLnNldFByb3BlcnR5KCAnLS1nby1uYXZpZ2F0aW9uLS1jb2xvci0tdGV4dCcsIHNldFRvICk7XG5cdFx0XHRkb2N1bWVudC5xdWVyeVNlbGVjdG9yKCAnOnJvb3QnICkuc3R5bGUuc2V0UHJvcGVydHkoICctLWdvLXNpdGUtZGVzY3JpcHRpb24tLWNvbG9yLS10ZXh0Jywgc2V0VG8gKTtcblx0XHRcdGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoICc6cm9vdCcgKS5zdHlsZS5zZXRQcm9wZXJ0eSggJy0tZ28tc2VhcmNoLWJ1dHRvbi0tY29sb3ItLXRleHQnLCBzZXRUbyApO1xuXHRcdFx0ZG9jdW1lbnQucXVlcnlTZWxlY3RvciggJzpyb290JyApLnN0eWxlLnNldFByb3BlcnR5KCAnLS1nby1zaXRlLXRpdGxlLS1jb2xvci0tdGV4dCcsIHNldFRvICk7XG5cdFx0fSApO1xuXHR9ICk7XG59O1xuIiwiZXhwb3J0IGRlZmF1bHQgKCkgPT4ge1xuXHQvKipcblx0ICogU2V0IExvZ28gd2lkdGguXG5cdCAqXG5cdCAqIEBwYXJhbSB7Kn0gd2lkdGhcblx0ICovXG5cdGNvbnN0IHNldExvZ29XaWR0aCA9ICggd2lkdGggKSA9PiB7XG5cdFx0ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LnN0eWxlLnNldFByb3BlcnR5KCAnLS1nby1sb2dvLS1tYXgtd2lkdGgnLCB3aWR0aCA/IGAke3dpZHRofXB4YCA6ICdub25lJyApO1xuXHR9O1xuXG5cdC8qKlxuXHQgKiBTZXQgTG9nbyBtb2JpbGUgd2lkdGguXG5cdCAqXG5cdCAqIEBwYXJhbSB7Kn0gd2lkdGhcblx0ICovXG5cdGNvbnN0IHNldExvZ29Nb2JpbGVXaWR0aCA9ICggd2lkdGggKSA9PiB7XG5cdFx0ZG9jdW1lbnQuZG9jdW1lbnRFbGVtZW50LnN0eWxlLnNldFByb3BlcnR5KCAnLS1nby1sb2dvLW1vYmlsZS0tbWF4LXdpZHRoJywgd2lkdGggPyBgJHt3aWR0aH1weGAgOiAnbm9uZScgKTtcblx0fTtcblxuXHR3cC5jdXN0b21pemUoICdsb2dvX3dpZHRoJywgKCB2YWx1ZSApID0+IHtcblx0XHR2YWx1ZS5iaW5kKCAoIHRvICkgPT4gc2V0TG9nb1dpZHRoKCB0byApICk7XG5cdH0gKTtcblxuXHR3cC5jdXN0b21pemUoICdsb2dvX3dpZHRoX21vYmlsZScsICggdmFsdWUgKSA9PiB7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHNldExvZ29Nb2JpbGVXaWR0aCggdG8gKSApO1xuXHR9ICk7XG59O1xuIiwiY29uc3QgJCA9IGpRdWVyeTsgLy8gZXNsaW50LWRpc2FibGUtbGluZVxuXG5leHBvcnQgZGVmYXVsdCAoKSA9PiB7XG5cblx0d3AuY3VzdG9taXplKCAncGFnZV90aXRsZXMnLCAoIHZhbHVlICkgPT4ge1xuXHRcdGNvbnN0IHNlbGVjdG9ycyA9ICcjY29udGVudCA+IC5lbnRyeS1oZWFkZXIsIGJvZHkucGFnZSBhcnRpY2xlIC5lbnRyeS1oZWFkZXIsIGJvZHkud29vY29tbWVyY2UgLmVudHJ5LWhlYWRlcic7XG5cdFx0dmFsdWUuYmluZCggKCB0byApID0+IHtcblx0XHRcdGlmICggdG8gKSB7XG5cdFx0XHRcdCQoICdib2R5JyApLmFkZENsYXNzKCAnaGFzLXBhZ2UtdGl0bGVzJyApO1xuXHRcdFx0XHQkKCBzZWxlY3RvcnMgKS5yZW1vdmVDbGFzcyggJ2Rpc3BsYXktbm9uZScgKTtcblxuXHRcdFx0fSBlbHNlIHtcblx0XHRcdFx0JCggJ2JvZHknICkucmVtb3ZlQ2xhc3MoICdoYXMtcGFnZS10aXRsZXMnICk7XG5cdFx0XHRcdCQoIHNlbGVjdG9ycyApLmFkZENsYXNzKCAnZGlzcGxheS1ub25lJyApO1xuXG5cdFx0XHR9XG5cdFx0fSApO1xuXHR9ICk7XG5cbn07XG4iLCIvKipcbiAqIEZ1bmN0aW9ucyB0byBjb252ZXJ0IGhleCBjb2xvciB0byBIU0xcbiAqIEBwYXJhbSB7Kn0gSFxuICovXG5leHBvcnQgZnVuY3Rpb24gaGV4VG9IU0woIEggKSB7XG5cdC8vIENvbnZlcnQgaGV4IHRvIFJHQiBmaXJzdFxuXHRsZXQgciA9IDAsXG5cdFx0ZyA9IDAsXG5cdFx0YiA9IDA7XG5cdGlmICggNCA9PSBILmxlbmd0aCApIHtcblx0XHRyID0gYDB4JHsgIEhbMV0gIH0ke0hbMV19YDtcblx0XHRnID0gYDB4JHsgIEhbMl0gIH0ke0hbMl19YDtcblx0XHRiID0gYDB4JHsgIEhbM10gIH0ke0hbM119YDtcblx0fSBlbHNlIGlmICggNyA9PSBILmxlbmd0aCApIHtcblx0XHRyID0gYDB4JHsgIEhbMV0gIH0ke0hbMl19YDtcblx0XHRnID0gYDB4JHsgIEhbM10gIH0ke0hbNF19YDtcblx0XHRiID0gYDB4JHsgIEhbNV0gIH0ke0hbNl19YDtcblx0fVxuXG5cdC8vIFRoZW4gdG8gSFNMXG5cdHIgLz0gMjU1O1xuXHRnIC89IDI1NTtcblx0YiAvPSAyNTU7XG5cblx0Y29uc3QgY21pbiA9IE1hdGgubWluKCByLCBnLCBiICksXG5cdFx0Y21heCA9IE1hdGgubWF4KCByLCBnLCBiICksXG5cdFx0ZGVsdGEgPSBjbWF4IC0gY21pbjtcblxuXHRsZXQgaCA9IDA7XG5cdGxldFx0cyA9IDA7XG5cdGxldCBsID0gMDtcblxuXG5cdGlmICggMCA9PSBkZWx0YSApIGggPSAwO1xuXHRlbHNlIGlmICggY21heCA9PSByICkgaCA9ICggKCBnIC0gYiApIC8gZGVsdGEgKSAlIDY7XG5cdGVsc2UgaWYgKCBjbWF4ID09IGcgKSBoID0gKCBiIC0gciApIC8gZGVsdGEgKyAyO1xuXHRlbHNlIGggPSAoIHIgLSBnICkgLyBkZWx0YSArIDQ7XG5cblx0aCA9IE1hdGgucm91bmQoIGggKiA2MCApO1xuXG5cdGlmICggMCA+IGggKSBoICs9IDM2MDtcblxuXHRsID0gKCBjbWF4ICsgY21pbiApIC8gMjtcblx0cyA9IDAgPT0gZGVsdGEgPyAwIDogZGVsdGEgLyAoIDEgLSBNYXRoLmFicyggMiAqIGwgLSAxICkgKTtcblx0cyA9ICsoIHMgKiAxMDAgKS50b0ZpeGVkKCk7XG5cdGwgPSArKCBsICogMTAwICkudG9GaXhlZCgpO1xuXG5cdHJldHVybiBbaCwgcywgbF07XG59XG4iXSwibWFwcGluZ3MiOiI7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7Ozs7Ozs7Ozs7O0FDbEZBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFBQTtBQUFBO0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7Ozs7Ozs7Ozs7QUNaQTtBQUFBO0FBQUE7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQURBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBRUE7QUFHQTtBQUNBO0FBRUE7QUFFQTtBQUlBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFEQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFEQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBREE7QUFDQTtBQUlBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBOzs7Ozs7Ozs7Ozs7QUM5R0E7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBS0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFBQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBOzs7Ozs7Ozs7Ozs7QUNwQ0E7QUFBQTtBQUFBO0FBRUE7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUFBO0FBRUE7QUFDQTs7Ozs7Ozs7Ozs7O0FDOUpBO0FBQUE7QUFBQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7Ozs7Ozs7Ozs7OztBQ3JDQTtBQUFBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUVBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBREE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTs7Ozs7Ozs7Ozs7O0FDMUJBO0FBQUE7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBRUE7QUFDQTtBQUNBO0FBRUE7Ozs7Ozs7Ozs7OztBQ25CQTtBQUFBO0FBQUE7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFBQTtBQUFBO0FBQ0E7QUFFQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBQ0E7QUFDQTtBQUNBO0FBRUE7QUFBQTtBQUFBO0FBSUE7QUFDQTtBQUNBO0FBR0E7QUFLQTtBQUVBO0FBRUE7QUFDQTtBQUNBO0FBQ0E7QUFFQTtBQUNBOzs7O0EiLCJzb3VyY2VSb290IjoiIn0=