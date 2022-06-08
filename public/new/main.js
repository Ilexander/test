/*
 * ATTENTION: The "eval" devtool has been used (maybe by default in mode: "development").
 * This devtool is neither made for production nor for readable output files.
 * It uses "eval()" calls to create a separate source file in the browser devtools.
 * If you are trying to read the output file, select a different devtool (https://webpack.js.org/configuration/devtool/)
 * or disable the default devtool with "devtool: false".
 * If you are looking for production-ready output files, see mode: "production" (https://webpack.js.org/configuration/mode/).
 */
/******/ (function () {
    // webpackBootstrap
    /******/ "use strict";
    /******/ var __webpack_modules__ = {
        /***/ "./src/js/main.js":
            /*!************************!*\
  !*** ./src/js/main.js ***!
  \************************/
            /***/ function (
                __unused_webpack_module,
                __webpack_exports__,
                __webpack_require__
            ) {
                eval(
                    '__webpack_require__.r(__webpack_exports__);\n/* harmony import */ var _modules_setPopup__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(/*! ./modules/setPopup */ "./src/js/modules/setPopup.js");\n/* harmony import */ var _modules_toggle_qna__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(/*! ./modules/toggle-qna */ "./src/js/modules/toggle-qna.js");\n\r\n\r\n\r\n\r\n\r\nconst loginEmailPreloaded = document.getElementById("emailAuth"),\r\nloginPasswordPreloaded = document.getElementById("passwordAuth");\r\n\r\nif(loginEmailPreloaded && loginPasswordPreloaded) {\r\n    loginEmailPreloaded.value = "";\r\n    loginPasswordPreloaded.value = "";\r\n}   \r\n\r\nwindow.onload = function(){\r\n    let preloader = document.querySelector(\'.preloader\');\r\n    fadeOut(preloader);\r\n    setTimeout(() => {\r\n        preloader.remove();\r\n    }, 800)\r\n    \r\n\r\n    const body = document.querySelector(\'body\'),\r\n        html = document.querySelector(\'html\'),\r\n        bodyAuto = {\r\n            "overflow-y": "auto",\r\n            "height": "auto",\r\n        },\r\n        htmlAuto = {\r\n            "overflow-y": "auto",\r\n            "height": "auto",\r\n        },\r\n        bodyLocked = {\r\n            "overflow-y": "hidden",\r\n            "height": "100vh"\r\n        },\r\n        htmlLocked = {\r\n            "overflow-y": "hidden", \r\n            "height": "100vh"\r\n        }\r\n\r\n    if(body.classList.contains("home-page")) {\r\n        AOS.init();\r\n    }\r\n\r\n    function fadeOut(el, fadeDuration = 800) {\r\n        el.style.opacity = 1;\r\n        let startTime = -1;\r\n        function renderFade(currTime) {\r\n            let opacity = 1 - (currTime / fadeDuration);\r\n            el.style.opacity = opacity;\r\n        }\r\n        function eachFrame() {\r\n            let timeRunning = (new Date()).getTime() - startTime;\r\n            if (startTime < 0) {\r\n                startTime = (new Date()).getTime();\r\n                renderFade(0.0);\r\n            } else if (timeRunning < fadeDuration) {\r\n                renderFade(timeRunning);\r\n            } else {\r\n                el.style.display = "none";\r\n                el.style.opacity = 0;\r\n                return;\r\n            }\r\n        \r\n            window.requestAnimationFrame(eachFrame);\r\n        };\r\n        // start the animation\r\n        window.requestAnimationFrame(eachFrame);   \r\n    };\r\n\r\n    let langSelectMain = document.querySelector("._drop-down-current");\r\n    langSelectMain.addEventListener("click", () => {\r\n        let langDropdown = document.querySelector(".section-header__lang--list");\r\n        fadeIn(langDropdown);\r\n        document.addEventListener("click", function(e) {\r\n            let target = e.target;\r\n\r\n            if(target !== langDropdown && target !== langSelectMain && !target.classList.contains("section-header__lang--flag")) {\r\n                fadeOut(langDropdown, 400);\r\n            }\r\n            return;\r\n        });\r\n    })\r\n\r\n    function fadeIn(el, display) {\r\n        el.style.opacity = 0;\r\n        el.style.display = display || "block";\r\n        (function fade() {\r\n            var val = parseFloat(el.style.opacity);\r\n            if (!((val += .1) > 1)) {\r\n                el.style.opacity = val;\r\n                requestAnimationFrame(fade);\r\n            }\r\n        })();\r\n    };\r\n    function lockView() {\r\n        Object.assign(body.style, bodyLocked);\r\n        Object.assign(html.style, htmlLocked);\r\n    }\r\n    function unlockView() {\r\n        Object.assign(body.style, bodyAuto);\r\n        Object.assign(html.style, htmlAuto);\r\n    }\r\n\r\n    function enableSlider() {\r\n        let slideIndex = 0;\r\n\r\n        const moveSlide = (num) => {\r\n            if(num > 0) {\r\n                if(slideIndex + num > 3) {\r\n                    slideIndex = -1;\r\n                }\r\n                $(".slider-track").animate({"left": `${-(slideIndex + num) * 100}%`}, "slow");\r\n                if(window.innerWidth > 768) {\r\n                    $(".slider-arrows").fadeOut();\r\n                    $(".slider-arrows").fadeIn();\r\n                }\r\n                return slideIndex++;\r\n            } else {\r\n                if(slideIndex + num < 0) {\r\n                    slideIndex = 4;\r\n                }\r\n                $(".slider-track").animate({"left": `${-(slideIndex + num) * 100}%`}, "slow");\r\n                if(window.innerWidth > 768) {\r\n                    $(".slider-arrows").fadeOut();\r\n                    $(".slider-arrows").fadeIn();\r\n                }\r\n                return slideIndex--;\r\n            }\r\n        }\r\n        \r\n        //without if condition, scripts on faq.html breaks\r\n        if(document.querySelector(".slider-prev") && document.querySelector(".slider-next")) {\r\n            document.querySelector(".slider-next").addEventListener("click", () => {\r\n                moveSlide(1);\r\n            });\r\n            document.querySelector(".slider-prev").addEventListener("click", () => {\r\n                moveSlide(-1);\r\n            });\r\n        }\r\n    \r\n        let posX1 = 0,\r\n            posX2 = 0,\r\n            posInitial,\r\n            posFinal,\r\n            threshold = 100;\r\n    \r\n        $(".slider").on(\'touchstart\', dragStart),\r\n        $(".slider").on(\'touchend\', dragEnd),\r\n        $(".slider").on(\'touchmove\', dragAction)\r\n\r\n    \r\n        function dragStart (e) {\r\n            clearInterval(moveInterval);\r\n            e = e || window.event;\r\n            e.preventDefault();\r\n            posInitial = document.querySelector(".slider-track").offsetLeft;\r\n            \r\n            if (e.type == \'touchstart\') {\r\n                posX1 = e.touches[0].clientX;\r\n            } else {\r\n                posX1 = e.clientX;\r\n                document.onmouseup = dragEnd;\r\n                document.onmousemove = dragAction;\r\n            }\r\n        }\r\n    \r\n        function dragAction (e) {\r\n            e = e || window.event;\r\n            \r\n            if (e.type == \'touchmove\') {\r\n                posX2 = posX1 - e.touches[0].clientX;\r\n                posX1 = e.touches[0].clientX;\r\n            } else {\r\n                posX2 = posX1 - e.clientX;\r\n                posX1 = e.clientX;\r\n            }\r\n            document.querySelector(".slider-track").style.left = (document.querySelector(".slider-track").offsetLeft - posX2) + "px";\r\n        }\r\n        \r\n        function dragEnd (e) {\r\n            posFinal = document.querySelector(".slider-track").offsetLeft;\r\n            if (posFinal - posInitial < -threshold) {\r\n                moveSlide(1);\r\n            } else if (posFinal - posInitial > threshold) {\r\n                moveSlide(-1);\r\n            } else {\r\n                document.querySelector(".slider-track").style.left = (posInitial) + "px";\r\n            }\r\n    \r\n            document.onmouseup = null;\r\n            document.onmousemove = null;\r\n        }\r\n    \r\n        let moveInterval = setInterval(() => {\r\n            moveSlide(1);\r\n        }, 10000);\r\n    }\r\n\r\n    let apiHeaders = document.querySelectorAll(".api-header-block");\r\n    if(apiHeaders.length > 0) {\r\n        for(let i = 0; i < apiHeaders.length; i++) {\r\n            apiHeaders[i].addEventListener("click", (e) => {\r\n                let target = e.target,\r\n                    parent = target.parentElement,\r\n                    toggler = parent.querySelector(\'.api-toggler\');\r\n                toggleActive(parent, toggler);\r\n            }, {useCapture: true})\r\n        }\r\n    }\r\n\r\n    //material.io like input, prevElSibling = label\r\n    document.querySelectorAll(\'.popup-input-field\').forEach((input) => {\r\n        // $(input).focusin(() => {\r\n        //     $(input.closest(".popup-input-animated").querySelector(".popup-label")).addClass("popup-label-active");\r\n        // })\r\n     \r\n        input.addEventListener("focusin", function() {\r\n\r\n            (this.value.length === 0)? toggleActive(this.previousElementSibling) : "";\r\n        })\r\n        // $(input).focusout(() => {\r\n        //     if(input.value.length == 0) {\r\n        //         $(input.closest(".popup-input-animated").querySelector(".popup-label")).removeClass("popup-label-active");\r\n        //     } else {\r\n        //         return;\r\n        //     };\r\n        // })\r\n        input.addEventListener("focusout", function() {\r\n            (this.value.length === 0)? toggleActive(this.previousElementSibling) : "";\r\n\r\n            // if(this.value.length < 0) {\r\n            //     toggleActive(this.previousElementSibling);\r\n            // } else {\r\n            //     return;\r\n            // }\r\n        });\r\n    });\r\n\r\n    document.querySelectorAll("a").forEach(link => {\r\n        if(link.querySelector(".btn")) {\r\n            link.addEventListener("focus", () => {\r\n                link.querySelector(".btn").focus();\r\n            })\r\n        }\r\n    });\r\n\r\n    // $(".api-btn-details").on("click", () => {\r\n    //     let lastscroll = window.scrollY;\r\n    //     let closePopup = () => {\r\n    //         $(".api-popup").fadeOut();\r\n    //         $(".overlay").fadeOut();\r\n    //         window.scrollTo({\r\n    //             top: lastscroll,\r\n    //             behavior: "auto"\r\n    //         });\r\n    //     }\r\n    //     $(".overlay").fadeIn();\r\n    //     $(".api-popup").fadeIn();\r\n    //     $(".api-popup").css("display", "flex");\r\n\r\n    //     $(".overlay").on("click", () => {\r\n    //         closePopup();\r\n    //     })\r\n    //     $(".api-popup-btn").on("click", () => {\r\n    //         closePopup();\r\n    //     })\r\n    //     $(window).on("keydown", (e) => {\r\n    //         if(e.keyCode === 27) {\r\n    //             closePopup();\r\n    //         }\r\n    //     })\r\n    // });\r\n\r\n    const apiDetailsBtns = document.querySelectorAll(".api-btn-details");\r\n    if(apiDetailsBtns.length > 0) {\r\n        for(let i = 0; i < apiDetailsBtns.length; i++) {\r\n            apiDetailsBtns[i].addEventListener("click", function(){\r\n\r\n                createDetailsCard();\r\n\r\n                let lastscroll = window.scrollY,\r\n                    detailsCard = document.querySelector(".api-popup");\r\n\r\n                toggleModalWindow(detailsCard);\r\n                lockView();\r\n                detailsCard.style.display = "flex";\r\n\r\n                const overlay = document.querySelector(".overlay-menu"),\r\n                apiPopupBtn = document.querySelector(".api-popup-btn");\r\n                overlay.addEventListener("click", () => {\r\n                    toggleModalWindow(detailsCard);\r\n                    unlockView();\r\n                    window.scrollTo({\r\n                        top: lastscroll,\r\n                        behavior: "auto"\r\n                    });\r\n                });\r\n                apiPopupBtn.addEventListener("click", () => {\r\n                    toggleModalWindow(detailsCard);\r\n                    unlockView();\r\n                    window.scrollTo({\r\n                        top: lastscroll,\r\n                        behavior: "auto"\r\n                    });\r\n                });\r\n                document.addEventListener("keydown", (e) => {\r\n                    if(e.keyCode === 27) {\r\n                        toggleModalWindow(detailsCard);\r\n                        unlockView();\r\n                        window.scrollTo({\r\n                            top: lastscroll,\r\n                            behavior: "auto"\r\n                        });\r\n                    }\r\n                })\r\n\r\n            })\r\n        }\r\n    }\r\n\r\n    function createDetailsCard() {\r\n        const detailsCard = document.createElement("div");\r\n        detailsCard.classList.add("api-popup");\r\n\r\n        detailsCard.innerHTML = `\r\n            <div class="api-popup-header" id="api-popup-header">Loading...</div>\r\n            <p class="api-popup-paragraph" id="api-popup-paragraph-descr">Loading description...</p>\r\n            <p class="api-popup-paragraph">use only open pages!</p>\r\n            <p class="api-popup-paragraph">if you want a special price - write to tickets\r\n                special prices for regular customers</p>\r\n            <div class="api-popup-cancel">\r\n                <button class="api-popup-btn">Cancel</button>\r\n            </div>\r\n        `;\r\n\r\n        body.appendChild(detailsCard);\r\n    }\r\n\r\n    \r\n    function toggleApiImg() {\r\n        const apiExample = document.querySelector(".api-example");\r\n        if(apiExample) {\r\n            apiExample.addEventListener("click", () => {\r\n                let lastscroll = window.scrollY,\r\n                    apiImage = document.querySelector(".api-image");\r\n                lockView();\r\n                fadeIn(apiImage);\r\n                toggleOverlay(true);\r\n\r\n                document.addEventListener("click", (e) => {\r\n                    if(e.target.classList.contains("overlay-menu")) {\r\n                        fadeOut(apiImage);\r\n                        toggleOverlay(false);\r\n                        unlockView();\r\n                        window.scrollTo({\r\n                            top: lastscroll,\r\n                            behavior: "auto"\r\n                        });\r\n                    }\r\n                    return;\r\n                });\r\n                document.addEventListener("keydown", e => {\r\n                    if(e.keyCode === 27) {\r\n                        fadeOut(apiImage);\r\n                        toggleOverlay(false);\r\n                        unlockView();\r\n                        window.scrollTo({\r\n                            top: lastscroll,\r\n                            behavior: "auto"\r\n                        });\r\n                    }\r\n                })\r\n            });\r\n        }\r\n    }\r\n\r\n    // let toggleApiImg = () => {\r\n    //     $(".api-example").on("click", () => {\r\n    //         let lastscroll = window.scrollY;\r\n    //         $(".overlay").fadeIn();\r\n    //         $(".api-image").fadeIn();\r\n    //         $("html, body").css({"overflow-y": "hidden", "height": "100vh"});\r\n    \r\n    //         document.addEventListener(\'mouseup\', (e) => {\r\n    //             if ($(e.target).is(\'.api-image\')) return;\r\n    //             $(".api-image").fadeOut();\r\n    //             $(".overlay").fadeOut()\r\n    //             $("html, body").css({"overflow-y": "auto", "height": "auto"});\r\n    //             window.scrollTo({\r\n    //                 top: lastscroll,\r\n    //                 behavior: "auto"\r\n    //             });\r\n    //         })\r\n    \r\n    //         $(document).on("keydown", (e) => {\r\n    //             if(e.keyCode === 27) {\r\n    //                 $(".api-image").fadeOut();\r\n    //                 $(".overlay").fadeOut();\r\n    //                 $("html, body").css({"overflow-y": "auto", "height": "auto"});\r\n    //                 window.scrollTo({\r\n    //                     top: lastscroll,\r\n    //                     behavior: "auto"\r\n    //                 });\r\n    //             }\r\n    //         })\r\n    //     })\r\n    // }\r\n\r\n    function toggleModalWindow(modal) {\r\n        if(Math.round(+(modal.style.opacity)) === 1) {\r\n            fadeOut(modal);\r\n            setTimeout(() => {\r\n                modal.remove();\r\n            }, 800)\r\n            removeOverlay();\r\n        } else {\r\n            createOverlay();\r\n            fadeIn(modal);\r\n        }\r\n    }\r\n\r\n    function enableSubscriptionBtn() {\r\n        const subscribeBtn = document.querySelector(".newsletter-submit");\r\n        if(subscribeBtn) {\r\n            subscribeBtn.addEventListener("click", (e) => {\r\n                e.preventDefault();\r\n                toggleThanksModal();\r\n    \r\n                let overlay = document.querySelector(".overlay-menu"),\r\n                    modalCloseBtn = document.querySelector(".thanks-modal-btn");\r\n                document.addEventListener("keydown", (e) => {\r\n                    if(e.keyCode === 27) {\r\n                        toggleThanksModal();\r\n                    }\r\n                })\r\n                modalCloseBtn.addEventListener("click", () => {\r\n                    toggleThanksModal();\r\n                });\r\n                overlay.addEventListener("click", () => {\r\n                    toggleThanksModal();\r\n                });\r\n                \r\n            });\r\n            $("#emailNewsletterForm").validate({\r\n                errorClass: "popup-input-error-colored",\r\n                validClass: "popup-input-valid",\r\n                rules: {\r\n                    emailNewsletter: {\r\n                        email: true,\r\n                        required: true\r\n                    }\r\n                }\r\n            });\r\n        } else {\r\n            return;\r\n        }\r\n    }\r\n\r\n    function toggleActive(...items) {\r\n        for(let i = 0; i < items.length; i++) {\r\n            let mainClass = items[i].classList[0];\r\n            items[i].classList.toggle(mainClass + \'-active\');\r\n        }\r\n    }\r\n\r\n    function createOverlay() {\r\n        let overlay = document.createElement("div"),\r\n        body = document.querySelector("body");\r\n        overlay.classList.add("overlay-menu");\r\n        body.appendChild(overlay);\r\n        fadeIn(overlay);\r\n    }\r\n\r\n    function removeOverlay() {\r\n        let overlay = document.querySelector(".overlay-menu");\r\n        fadeOut(overlay);\r\n        setTimeout(() => {overlay.remove();}, 800);\r\n    }\r\n\r\n    function toggleThanksModal() {\r\n        try {\r\n            const thanksModal = document.querySelector(".thanks-modal");\r\n            toggleModalWindow(thanksModal);\r\n        } catch {\r\n            let thanksModal = document.createElement("div"),\r\n                body = document.querySelector("body");\r\n            thanksModal.classList.add("thanks-modal");\r\n            thanksModal.innerHTML = `\r\n                <div class="thanks-modal-content">\r\n                    <div class="thanks-modal-header">Thanks for your subscription!</div>\r\n                    <div class="thanks-modal-text">Check out the mail box, we\'ve dropped something cool!</div>\r\n                    <div class="thanks-modal-holder">\r\n                        <div class="thanks-modal-btn">Wow, nice!</div>\r\n                    </div>\r\n                </div>\r\n            `;\r\n            body.append(thanksModal);\r\n            toggleModalWindow(thanksModal);\r\n        }\r\n    }\r\n\r\n    function enableNavbar() {\r\n        const navbar = document.querySelector(".navbar"),\r\n              burger = navbar.querySelector(".navbar-hamburger"),\r\n              navbarLogo = navbar.querySelector(".navbar-logo"),\r\n              navbarHidden = navbar.querySelector(".navbar-hidden"),\r\n              burgerBars = burger.querySelectorAll(".navbar-hamburger-bar");\r\n      \r\n        burger.addEventListener("click", function() {\r\n            for(let i = 0; i < burgerBars.length; i++) {\r\n                burgerBars[i].classList.toggle("navbar-hamburger-bar-active");\r\n            }\r\n\r\n            toggleActive(navbar, navbarLogo, navbarHidden, burger);\r\n\r\n            if(navbar.classList.contains("navbar-active")) {\r\n                toggleOverlay(true);\r\n            } else {\r\n                toggleOverlay(false);\r\n            }\r\n        })\r\n    }\r\n\r\n    function toggleOverlay(isActive) {\r\n        if(isActive === true) {\r\n            createOverlay();\r\n        } else {\r\n            removeOverlay();\r\n        }\r\n    }\r\n\r\n    try {const navbarLang = document.querySelector(".navbar-lang-option");\r\n    navbarLang.addEventListener("click", function() {\r\n        toggleActive(this);\r\n    })}catch{}\r\n\r\n    \r\n\r\n  try {  function enableResetRequestBtn() {\r\n        const formForgot = document.getElementById("form-forgot"),\r\n              requestBtn = formForgot.querySelector(".signup-btn");\r\n        if(requestBtn) {\r\n            const popupForgot = document.querySelector(".popup-forgot"),\r\n                resetInput = document.getElementById("emailReset"),\r\n                requestInput = resetInput.value;\r\n\r\n                \r\n    \r\n            requestBtn.addEventListener("click", (e) => {\r\n                e.preventDefault();\r\n                fadeOut(popupForgot);\r\n                toggleOverlay(true);\r\n\r\n                const modalSent = document.createElement("div");\r\n                modalSent.classList.add("modal-sent")\r\n                modalSent.innerHTML = `\r\n                    <div class="modal-sent-header">Thank you!</div>\r\n                    <div class="modal-sent-subheader"></div>\r\n                    <div class="modal-sent-holder">\r\n                        <button class="modal-sent-btn">Cool!</button>\r\n                    </div>\r\n                `;\r\n                body.appendChild(modalSent);\r\n\r\n                let modalSentSubheader = document.querySelector(".modal-sent-subheader"),\r\n                    modalSentBtn = document.querySelector(".modal-sent-btn");\r\n                modalSentSubheader.innerText = `A password reset email has been sent to ${requestInput}.`;\r\n                fadeIn(modalSent);\r\n                unlockView();\r\n\r\n                const routeForgotInput = document.getElementById("route-forgot"),\r\n                      routeForgot = routeForgotInput.value,\r\n                      emailForgot = document.getElementById("emailReset").value,\r\n                      tokenForgot = routeForgotInput.getAttribute("data-token");\r\n                console.log(emailForgot);\r\n                console.log(routeForgot);\r\n                // $.ajax({\r\n                //     type: "post",\r\n                //     url: `${routeForgot}`,\r\n                //     data: {\r\n                //         email: `${emailForgot}`,\r\n                //         _token : `${tokenForgot}`\r\n                //     }\r\n                // })\r\n                // .done(console.log("email sent"))\r\n                // .catch(err => console.log(err));\r\n\r\n                axios({\r\n                    method: "post",\r\n                    url: `${routeForgot}`,\r\n                    data: {\r\n                        email: `${emailForgot}`,\r\n                        _token : `${tokenForgot}`\r\n                    }\r\n                })\r\n                .then(console.log("email sent"))\r\n                .catch(err => console.log(err));\r\n    \r\n                const overlay = document.querySelector(".overlay-menu");\r\n    \r\n                modalSentBtn.addEventListener("click", () => {\r\n                    toggleModalWindow(modalSent);\r\n                });\r\n                document.addEventListener("keydown", (e) => {\r\n                    if(e.keyCode === 27) {\r\n                        toggleModalWindow(modalSent);\r\n                    }\r\n                });\r\n                overlay.addEventListener("click", () => {\r\n                    toggleModalWindow(modalSent);\r\n                });\r\n            });\r\n        } else {\r\n            return;\r\n        }\r\n    }} catch {}\r\n\r\n//    $(".request-btn").on("submit", (e) => {\r\n//        e.preventDefault();\r\n//         $(".popup-forgot").fadeOut();\r\n//         $(".overlay-menu").fadeIn();\r\n//         $(".modal-sent").fadeIn();\r\n//         let requestInput = $("#emailReset").val();\r\n//         $(".modal-sent-subheader").text(`A password reset email has been sent to ${requestInput}.`);\r\n//         $("body, html").css({"overflow": "auto", "height": "auto" });\r\n\r\n\r\n//         $(document).on("keydown", (e) => {\r\n//             if(e.keyCode === 27) {\r\n//                 $(".modal-sent").fadeOut();\r\n//                 $(".overlay-menu").fadeOut();\r\n//             }\r\n//         })\r\n//         $(document).on("click", (e) => {\r\n//             if($(e.target).is(".modal-sent") || $(e.target).is(".request-btn")) {\r\n//                 return;\r\n//             } else {\r\n//                 $(".modal-sent").fadeOut();\r\n//                 $(".overlay-menu").fadeOut();\r\n//             }\r\n//         })\r\n//    });\r\n\r\n    function lockAutocompleteOverlapping() {\r\n        const loginEmail = document.getElementById("emailAuth"),\r\n              loginPassword = document.getElementById("passwordAuth");\r\n\r\n\r\n        if(loginEmail && loginPassword) {\r\n            loginEmail.value = "";\r\n           \r\n\r\n         \r\n\r\n            loginEmail.addEventListener(\'input\', (e) => {\r\n                \r\n            });\r\n            loginEmail.addEventListener(\'touchstart\', (e) => {\r\n               \r\n                e.target.addEventListener(\'focusout\', (e) => {\r\n                   \r\n                });\r\n            });\r\n            loginEmail.addEventListener(\'focus\', (e) => {\r\n     \r\n                (e.target).addEventListener(\'focusout\', (e) => {\r\n   \r\n                });\r\n            });\r\n            loginPassword.addEventListener(\'input\', (e) => {\r\n                \r\n            });\r\n            loginPassword.addEventListener(\'touchstart\', (e) => {\r\n   \r\n                e.target.addEventListener(\'focusout\', (e) => {\r\n\r\n                });\r\n            });\r\n            loginPassword.addEventListener(\'focus\', (e) => {\r\n \r\n                (e.target).addEventListener(\'focusout\', (e) => {\r\n ;\r\n                });\r\n            });\r\n        }\r\n   }\r\n\r\n    let formForgot = document.getElementById("form-forgot");\r\n    if(formForgot) {\r\n        $("#form-forgot").validate({\r\n            errorClass: "popup-input-error popupError",\r\n            validClass: "popup-input-valid",\r\n            rules: {\r\n                emailReset: {\r\n                    required: true,\r\n                    email: true,\r\n                },\r\n            },\r\n        });\r\n    }\r\n\r\n   enableNavbar();\r\n   (0,_modules_setPopup__WEBPACK_IMPORTED_MODULE_0__["default"])();\r\n   lockAutocompleteOverlapping();\r\n  try{ enableResetRequestBtn()} catch {};\r\n   enableSlider();\r\n   toggleApiImg();\r\n   (0,_modules_toggle_qna__WEBPACK_IMPORTED_MODULE_1__["default"])();\r\n   enableSubscriptionBtn();\r\n}\r\n\r\n\r\n\n\n//# sourceURL=webpack://solartest/./src/js/main.js?'
                );

                /***/
            },

        /***/ "./src/js/modules/setPopup.js":
            /*!************************************!*\
  !*** ./src/js/modules/setPopup.js ***!
  \************************************/
            /***/ function (
                __unused_webpack_module,
                __webpack_exports__,
                __webpack_require__
            ) {
                eval(
                    '__webpack_require__.r(__webpack_exports__);\n\r\nconst setPopup = () => {\r\n    document.querySelectorAll(\'[data-register]\').forEach((node) => {\r\n        node.addEventListener(\'click\', () => {\r\n            let lastscroll = window.scrollY;\r\n            $(".popup").fadeIn();\r\n            $("body, html").css({"overflow-y": "hidden", "height": "100%"})\r\n            \r\n            // document.addEventListener(\'mouseup\', (e) => {\r\n            //     if (document.querySelector(\'.popup-form\').contains(e.target)) return;\r\n            //     $(".popup").fadeOut();\r\n            //     $("html, body").css({"overflow-y": "auto", "height": "auto"});\r\n            //     window.scrollTo({\r\n            //         top: lastscroll,\r\n            //         behavior: "auto"\r\n            //     });\r\n            // })\r\n    \r\n            $(document).on("keydown", (e) => {\r\n                if(e.keyCode === 27) {\r\n                    $(".popup").fadeOut();\r\n                    $("html, body").css({"overflow-y": "auto", "height": "auto"});\r\n                    window.scrollTo({\r\n                        top: lastscroll,\r\n                        behavior: "auto"\r\n                    });\r\n                }\r\n            })\r\n            $(".popup-close").on("click", () => {\r\n                $(".popup").fadeOut();\r\n                $("html, body").css({"overflow-y": "auto", "height": "auto"});\r\n                window.scrollTo({\r\n                    top: lastscroll,\r\n                    behavior: "auto"\r\n                });\r\n            })\r\n            document.addEventListener("click", (e) => {\r\n                if($(e.target).is("form")) return;\r\n            })\r\n        })\r\n    });\r\n\r\n    // document.querySelectorAll(\'[data-login]\').forEach((node) => {\r\n    //     node.addEventListener(\'click\', (e) => {\r\n    //         e.preventDefault();\r\n    //         let lastscroll = window.scrollY;\r\n    //         $(".popup-login").fadeIn();\r\n    //         $("body, html").css({"overflow-y": "hidden", "height": "100%"})\r\n            \r\n    //         // if(window.innerWidth > 768) {\r\n    //         //     document.addEventListener(\'mouseup\', (e) => {\r\n    //         //         if (document.querySelector(\'.popup-form\').contains(e.target)) return;\r\n    //         //         $(".popup-login").fadeOut();\r\n    //         //         $("html, body").css({"overflow-y": "auto", "height": "auto"});\r\n    //         //         window.scrollTo({\r\n    //         //             top: lastscroll,\r\n    //         //             behavior: "auto"\r\n    //         //         });\r\n    //         //     })\r\n    //         // }\r\n    \r\n    //         $(document).on("keydown", (e) => {\r\n    //             if(e.keyCode === 27) {\r\n    //                 $(".popup-login").fadeOut();\r\n    //                 $("html, body").css({"overflow-y": "auto", "height": "auto"});\r\n    //                 window.scrollTo({\r\n    //                     top: lastscroll,\r\n    //                     behavior: "auto"\r\n    //                 });\r\n    //             }\r\n    //         })\r\n    //         $(".popup-close").on("click", () => {\r\n    //             $(".popup-login").fadeOut();\r\n    //             $("html, body").css({"overflow-y": "auto", "height": "auto"});\r\n    //             window.scrollTo({\r\n    //                 top: lastscroll,\r\n    //                 behavior: "auto"\r\n    //             });\r\n    //         })\r\n    //         document.addEventListener("click", (e) => {\r\n    //             if((e.target).is("form")) return;\r\n    //         })\r\n    //     })\r\n    // });\r\n\r\n    // document.querySelectorAll(\'[data-forgot]\').forEach((node) => {\r\n    //     node.addEventListener(\'click\', (e) => {\r\n    //         e.preventDefault();\r\n    //         let lastscroll = window.scrollY;\r\n    //         $(".popup-forgot").fadeIn();\r\n    //         $("body, html").css({"overflow-y": "hidden", "height": "100%"})\r\n            \r\n    //         if(window.innerWidth > 768) {\r\n    //             document.addEventListener(\'mouseup\', (e) => {\r\n    //                 if (document.querySelector(\'.popup-form\').contains(e.target)) return;\r\n    //                 $(".popup-login").fadeOut();\r\n    //                 $("html, body").css({"overflow-y": "auto", "height": "auto"});\r\n    //                 window.scrollTo({\r\n    //                     top: lastscroll,\r\n    //                     behavior: "auto"\r\n    //                 });\r\n    //             })\r\n    //         }\r\n    \r\n    //         $(document).on("keydown", (e) => {\r\n    //             if(e.keyCode === 27) {\r\n    //                 $(".popup-forgot").fadeOut();\r\n    //                 $("html, body").css({"overflow-y": "auto", "height": "auto"});\r\n    //                 window.scrollTo({\r\n    //                     top: lastscroll,\r\n    //                     behavior: "auto"\r\n    //                 });\r\n    //             }\r\n    //         })\r\n    //         $(".popup-close").on("click", () => {\r\n    //             $(".popup-forgot").fadeOut();\r\n    //             $("html, body").css({"overflow-y": "auto", "height": "auto"});\r\n    //             window.scrollTo({\r\n    //                 top: lastscroll,\r\n    //                 behavior: "auto"\r\n    //             });\r\n    //         })\r\n    //         document.addEventListener("click", (e) => {\r\n    //             if($(e.target).is("form")) return;\r\n    //         })\r\n    //     })\r\n    // });\r\n\r\n\r\n    $(".popup-submit-btn").on("click", (e) => {\r\n        e.preventDefault();\r\n        // validateReg(".popup-form"); \r\n    })\r\n\r\n    let validateReg = (formValidated) => {\r\n        $(formValidated).validate({\r\n            errorClass: "popup-input-error",\r\n            validClass: "popup-input-valid",\r\n            rules: {\r\n                    email: {\r\n                        required: true,\r\n                        email: true,\r\n                    },\r\n                    fName: {\r\n                        required: true,\r\n                        minlength: 2,\r\n                    },\r\n                    lName: {\r\n                        required: true,\r\n                        minlength: 2,\r\n                    },\r\n                    password: {\r\n                        minlength: 8,\r\n                        checkRegExp: true,\r\n                    },\r\n                    conpassword: {\r\n                        minlength: 8,\r\n                        equalTo: \'[name="password"]\',\r\n                        checkRegExp: true,\r\n                    }\r\n            }\r\n        });\r\n    }\r\n\r\n    $.validator.addMethod(\'checkRegExp\', function (value) { \r\n        return /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])([a-zA-Z0-9!@#$%^&*]{8,})$/.test(value); \r\n    }, \'The password must contain at least one capital letter and one digit\');\r\n\r\n \r\n\r\n    validateReg(".popup-form");\r\n}\r\n\r\n/* harmony default export */ __webpack_exports__["default"] = (setPopup);\n\n//# sourceURL=webpack://solartest/./src/js/modules/setPopup.js?'
                );

                /***/
            },

        /***/ "./src/js/modules/toggle-qna.js":
            /*!**************************************!*\
  !*** ./src/js/modules/toggle-qna.js ***!
  \**************************************/
            /***/ function (
                __unused_webpack_module,
                __webpack_exports__,
                __webpack_require__
            ) {
                eval(
                    '__webpack_require__.r(__webpack_exports__);\nlet toggleQna = () => {\r\n    const qna = document.querySelectorAll(".faq-qna");\r\n    \r\n    qna.forEach((qna) => {\r\n        qna.addEventListener(\'click\', () => {\r\n            showAnswers(qna);\r\n        }, {useCapture: true});\r\n    });\r\n\r\n    function showAnswers(item) {\r\n        item.classList.toggle("faq-qna-active");\r\n        item.querySelector(".faq-toggler").classList.toggle("faq-toggler-active");\r\n        item.querySelector(".faq-question").classList.toggle("faq-question-active");\r\n    }\r\n}\r\n\r\n/* harmony default export */ __webpack_exports__["default"] = (toggleQna);\n\n//# sourceURL=webpack://solartest/./src/js/modules/toggle-qna.js?'
                );

                /***/
            },

        /******/
    };
    /************************************************************************/
    /******/ // The module cache
    /******/ var __webpack_module_cache__ = {};
    /******/
    /******/ // The require function
    /******/ function __webpack_require__(moduleId) {
        /******/ // Check if module is in cache
        /******/ var cachedModule = __webpack_module_cache__[moduleId];
        /******/ if (cachedModule !== undefined) {
            /******/ return cachedModule.exports;
            /******/
        }
        /******/ // Create a new module (and put it into the cache)
        /******/ var module = (__webpack_module_cache__[moduleId] = {
            /******/ // no module.id needed
            /******/ // no module.loaded needed
            /******/ exports: {},
            /******/
        });
        /******/
        /******/ // Execute the module function
        /******/ __webpack_modules__[moduleId](
            module,
            module.exports,
            __webpack_require__
        );
        /******/
        /******/ // Return the exports of the module
        /******/ return module.exports;
        /******/
    }
    /******/
    /************************************************************************/
    /******/ /* webpack/runtime/make namespace object */
    /******/ !(function () {
        /******/ // define __esModule on exports
        /******/ __webpack_require__.r = function (exports) {
            /******/ if (typeof Symbol !== "undefined" && Symbol.toStringTag) {
                /******/ Object.defineProperty(exports, Symbol.toStringTag, {
                    value: "Module",
                });
                /******/
            }
            /******/ Object.defineProperty(exports, "__esModule", {
                value: true,
            });
            /******/
        };
        /******/
    })();
    /******/
    /************************************************************************/
    /******/
    /******/ // startup
    /******/ // Load entry module and return exports
    /******/ // This entry module can't be inlined because the eval devtool is used.
    /******/ var __webpack_exports__ = __webpack_require__("./src/js/main.js");
    /******/
    /******/
})();

function validateEmail(email) {
    var re =
        /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    return re.test(String(email).toLowerCase());
}

const allInput = document.querySelectorAll(".input-auth");
const registerError = document.querySelector("#emailError");
const registerSignUp = document.querySelector(".signup-btn");
const registerInput = document.querySelectorAll(".popup-input-field");

try {
    const authInput = document.querySelector("#emailAuth");
    authInput.addEventListener("blur", (e) => {
        if (!validateEmail(e.target.value)) {
            e.target.parentElement
                .querySelector(".error")
                .classList.add("error-active");
            e.target.parentElement.querySelector(".error").textContent =
                "This field is not filled in correctly";
        } else {
            e.target.parentElement
                .querySelector(".error")
                .classList.remove("error-active");
            e.target.parentElement.querySelector(".error").textContent =
                "The email auth field is required.";
        }
    });
} catch (error) {}

// registerInput.addEventListener("blur", () => {
//     setInterval(() => {
//         !validateEmail(registerInput.value)
//             ? (registerError.textContent =
//                   "There's something wrong with the mail")
//             : (registerError.textContent = "");
//     }, 1000);
// });

registerInput.forEach((item) => {
    item.addEventListener("keydown", () => {
        const inputError = item.parentElement.querySelector(
            ".registerErrorClass"
        );

        try {
            inputError.style.display = "none";
        } catch (error) {}
    });
});

registerSignUp.addEventListener("click", () => {
    const errors = document.querySelectorAll(".registerErrorClass");
    document.querySelector("#email-error").style.display = "none";
    document.querySelector("#password-error").style.display = "none";
    document.querySelector(".confirm-error").style.display = "none";
    errors.forEach((item) => (item.style.display = "block"));
});

try {
    const authSubmitButton = document.querySelector(".btn-login");
    authSubmitButton.addEventListener("click", (e) => {
        allInput.forEach((item) => {
            if (item.value.length <= 3) {
                e.preventDefault();
                item.parentElement
                    .querySelector(".error")
                    .classList.add("error-active");
            } else {
                item.parentElement
                    .querySelector(".error")
                    .classList.remove("error-active");
            }
        });
    });
} catch (error) {}

const langBtn = document.querySelector(".section-header__lang--link");
const langList = document.querySelector(".section-header__lang--list");

langBtn.addEventListener("click", () => {
    langList.classList.toggle("section-header__lang--list--active");
});

const confirmPass = document.querySelector("#conpassword");
const pass = document.querySelector("#password");

confirmPass.addEventListener("keydown", () => {
    setTimeout(() => {
        if (confirmPass.value !== pass.value) {
            confirmPass.parentElement.querySelector(
                ".confirm-error"
            ).style.display = "block";
        } else {
            confirmPass.parentElement.querySelector(
                ".confirm-error"
            ).style.display = "none";
        }
    }, 500);
});

const newsSubmit = document.querySelector(".newsletter-submit");
const newsError = document.querySelector(".emailNewsError");

try {
    const newInput = document.querySelector("#emailNewsletter");

    newInput.addEventListener("keydown", () => {
        setTimeout(() => {
            if (!validateEmail(newInput.value)) {
                newInput.classList.add("popup-input-error-colored");
                newInput.classList.remove("popup-input-valid");
                newsError.style.display = "block";
                newsSubmit.setAttribute("disabled", "false");
            } else {
                newInput.classList.add("popup-input-valid");
                newInput.classList.remove("popup-input-error");
                newsError.style.display = "none";
                newsSubmit.removeAttribute("disabled");
            }
        }, 1000);
    });

    newsSubmit.addEventListener("mousemove", () => {
        if (!validateEmail(newInput.value)) {
            newsError.style.display = "block";
            newsSubmit.setAttribute("disabled", "false");
        } else {
            newsError.style.display = "none";
            newsSubmit.removeAttribute("disabled");
        }
    });
} catch (error) {}
const popupForgot = document.querySelector(".popup-forgot");

try {
    const forgot = document.querySelector(".about-forgot");
    forgot.addEventListener("click", () => {
        popupForgot.style.display === "none"
            ? (popupForgot.style.display = "block")
            : (popupForgot.style.display = "none");
    });
} catch (error) {}

try {
    const popupForgotClose = document.querySelector("#popup-forgot-close");
    popupForgotClose.addEventListener("click", () => {
        popupForgot.style.display = "none";
    });
} catch (error) {}
const anchors = document.querySelectorAll('a[href*="#"]');

for (let anchor of anchors) {
    anchor.addEventListener("click", function (e) {
        e.preventDefault();

        const blockID = anchor.getAttribute("href").substr(1);

        document.getElementById(blockID).scrollIntoView({
            behavior: "smooth",
            block: "start",
        });
    });
}

const emailInput = document.querySelector("#email");

emailInput.addEventListener("blur", () => {
    if (!validateEmail(emailInput.value)) {
        emailInput.classList.add("popup-input-error");
        document.querySelector("#email-error").style.display = "block";
        document.querySelector("#email-error").textContent =
            "Please enter a valid email address";
    } else {
        document.querySelector("#email-error").textContent = "";
        emailInput.classList.add("popup-input-valid");
        document.querySelector("#email-error").style.display = "none";
    }
});
