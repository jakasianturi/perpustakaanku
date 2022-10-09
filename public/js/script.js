/*
 * ATTENTION: An "eval-source-map" devtool has been used.
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file with attached SourceMaps in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (() => { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ "./resources/js/script.js":
/*!********************************!*\
  !*** ./resources/js/script.js ***!
  \********************************/
/***/ (() => {

eval("// Navbar Scroll Effect\ndocument.addEventListener(\"DOMContentLoaded\", function () {\n  var fixedNav = document.querySelector(\"#fixed-nav\"); // Window Scrolled\n\n  window.addEventListener(\"scroll\", function () {\n    if (window.scrollY > 150) {\n      fixedNav.classList.add(\"fixed-top\");\n      navbar_height = fixedNav.offsetHeight;\n      document.body.style.paddingTop = navbar_height + \"px\";\n    } else {\n      fixedNav.classList.remove(\"fixed-top\");\n      document.body.style.paddingTop = \"0\";\n    }\n  });\n});//# sourceURL=[module]\n//# sourceMappingURL=data:application/json;charset=utf-8;base64,eyJ2ZXJzaW9uIjozLCJzb3VyY2VzIjpbIndlYnBhY2s6Ly8vLi9yZXNvdXJjZXMvanMvc2NyaXB0LmpzPzg3MzMiXSwibmFtZXMiOlsiZG9jdW1lbnQiLCJhZGRFdmVudExpc3RlbmVyIiwiZml4ZWROYXYiLCJxdWVyeVNlbGVjdG9yIiwid2luZG93Iiwic2Nyb2xsWSIsImNsYXNzTGlzdCIsImFkZCIsIm5hdmJhcl9oZWlnaHQiLCJvZmZzZXRIZWlnaHQiLCJib2R5Iiwic3R5bGUiLCJwYWRkaW5nVG9wIiwicmVtb3ZlIl0sIm1hcHBpbmdzIjoiQUFBQTtBQUNBQSxRQUFRLENBQUNDLGdCQUFULENBQTBCLGtCQUExQixFQUE4QyxZQUFZO0FBQ3RELE1BQUlDLFFBQVEsR0FBR0YsUUFBUSxDQUFDRyxhQUFULENBQXVCLFlBQXZCLENBQWYsQ0FEc0QsQ0FFdEQ7O0FBQ0FDLEVBQUFBLE1BQU0sQ0FBQ0gsZ0JBQVAsQ0FBd0IsUUFBeEIsRUFBa0MsWUFBWTtBQUMxQyxRQUFJRyxNQUFNLENBQUNDLE9BQVAsR0FBaUIsR0FBckIsRUFBMEI7QUFDdEJILE1BQUFBLFFBQVEsQ0FBQ0ksU0FBVCxDQUFtQkMsR0FBbkIsQ0FBdUIsV0FBdkI7QUFDQUMsTUFBQUEsYUFBYSxHQUFHTixRQUFRLENBQUNPLFlBQXpCO0FBQ0FULE1BQUFBLFFBQVEsQ0FBQ1UsSUFBVCxDQUFjQyxLQUFkLENBQW9CQyxVQUFwQixHQUFpQ0osYUFBYSxHQUFHLElBQWpEO0FBQ0gsS0FKRCxNQUlPO0FBQ0hOLE1BQUFBLFFBQVEsQ0FBQ0ksU0FBVCxDQUFtQk8sTUFBbkIsQ0FBMEIsV0FBMUI7QUFDQWIsTUFBQUEsUUFBUSxDQUFDVSxJQUFULENBQWNDLEtBQWQsQ0FBb0JDLFVBQXBCLEdBQWlDLEdBQWpDO0FBQ0g7QUFDSixHQVREO0FBVUgsQ0FiRCIsInNvdXJjZXNDb250ZW50IjpbIi8vIE5hdmJhciBTY3JvbGwgRWZmZWN0XHJcbmRvY3VtZW50LmFkZEV2ZW50TGlzdGVuZXIoXCJET01Db250ZW50TG9hZGVkXCIsIGZ1bmN0aW9uICgpIHtcclxuICAgIGxldCBmaXhlZE5hdiA9IGRvY3VtZW50LnF1ZXJ5U2VsZWN0b3IoXCIjZml4ZWQtbmF2XCIpO1xyXG4gICAgLy8gV2luZG93IFNjcm9sbGVkXHJcbiAgICB3aW5kb3cuYWRkRXZlbnRMaXN0ZW5lcihcInNjcm9sbFwiLCBmdW5jdGlvbiAoKSB7XHJcbiAgICAgICAgaWYgKHdpbmRvdy5zY3JvbGxZID4gMTUwKSB7XHJcbiAgICAgICAgICAgIGZpeGVkTmF2LmNsYXNzTGlzdC5hZGQoXCJmaXhlZC10b3BcIik7XHJcbiAgICAgICAgICAgIG5hdmJhcl9oZWlnaHQgPSBmaXhlZE5hdi5vZmZzZXRIZWlnaHQ7XHJcbiAgICAgICAgICAgIGRvY3VtZW50LmJvZHkuc3R5bGUucGFkZGluZ1RvcCA9IG5hdmJhcl9oZWlnaHQgKyBcInB4XCI7XHJcbiAgICAgICAgfSBlbHNlIHtcclxuICAgICAgICAgICAgZml4ZWROYXYuY2xhc3NMaXN0LnJlbW92ZShcImZpeGVkLXRvcFwiKTtcclxuICAgICAgICAgICAgZG9jdW1lbnQuYm9keS5zdHlsZS5wYWRkaW5nVG9wID0gXCIwXCI7XHJcbiAgICAgICAgfVxyXG4gICAgfSk7XHJcbn0pO1xyXG4iXSwiZmlsZSI6Ii4vcmVzb3VyY2VzL2pzL3NjcmlwdC5qcy5qcyIsInNvdXJjZVJvb3QiOiIifQ==\n//# sourceURL=webpack-internal:///./resources/js/script.js\n");

/***/ })

/******/ 	});
/************************************************************************/
/******/ 	
/******/ 	// startup
/******/ 	// Load entry module and return exports
/******/ 	// This entry module can't be inlined because the eval-source-map devtool is used.
/******/ 	var __webpack_exports__ = {};
/******/ 	__webpack_modules__["./resources/js/script.js"]();
/******/ 	
/******/ })()
;