theme.directive('indyImg', ['$window', function ($window) {
        return {
            restrict: 'A',
            scope: true,
            controller: ["$scope", "$timeout", function ($scope, $timeout) {
                this.setWrapSize = function (value) {
                    $timeout(function () {
                        $scope.wrapSize = value;
                    });
                };
                this.setImgSize = function (value) {
                    $timeout(function () {
                        $scope.imgSize = value;
                    });
                };
            }],
            link: function (scope, element, attrs, ctrl) {
                setSize();
                scope.loading = true;
                element.find('img').bind('load', function () {
                    setSize();
                    scope.loading = false;
                });
                var appWindow = angular.element($window);
                appWindow.bind('resize', function () {
                    setSize();
                });

                function setSize() {
                    var wFrame = element[0].offsetWidth;
                    var hFrame = element[0].offsetHeight;
                    scope.hFrame = hFrame;
                    console.log(hFrame)

                    var wrapHeight = element[0].attributes["wrap-height"];
                    if (wrapHeight) {
                        hFrame = wFrame * wrapHeight.nodeValue;
                    }

                    var thisImg = element.find('img');
                    var wImg = thisImg[0].naturalWidth;
                    var hImg = thisImg[0].naturalHeight;

                    if (wrapHeight) {
                        ctrl.setWrapSize({
                            "height": hFrame + "px"
                        });
                    }
                    var hEnlarge = (hImg * wFrame) / wImg;
                    if (hEnlarge >= hFrame) {
                        var rest = hEnlarge - hFrame;
                        var part = rest / 2;
                        ctrl.setImgSize({
                            "marginTop": -(part) - 2 + "px",
                            "width": "100%",
                            "height": "auto"
                        });
                    } else {
                        var wEnlarge = (wImg * hFrame) / hImg;
                        var rest = wEnlarge - wFrame;
                        var part = rest / 2;
                        ctrl.setImgSize({
                            "marginLeft": -(part) + "px",
                            "height": hFrame + "px",
                            "width": "auto"
                        });
                    }
                };
            }
        };
    }])
    .directive("navSlider", ['$window', '$timeout', function ($window, $timeout) {
        return function (scope, element, attrs) {
            scope.toggleStatus = false;
            var isBusy = false;

            var resize = function () {
                if ($window.innerWidth > 780) {
                    scope.menuHeight = $window.innerHeight - attrs.top + 10;
                } else {
                    scope.menuHeight = $window.innerHeight - attrs.top;
                }
            }

            resize();
            angular.element($window).bind("resize", function () {
                resize();
                scope.$apply();
            });

            scope.toggle = function () {
                if (!isBusy) {
                    isBusy = true;
                    if (!scope.toggleStatus) {
                        scope.effect = "fadeInDown";
                        scope.toggleStatus = true;
                        $timeout(function () {
                            isBusy = false;
                        }, 1000);
                    } else {
                        scope.effect = "fadeOutUp";
                        $timeout(function () {
                            scope.toggleStatus = false;
                            isBusy = false;
                        }, 1000);
                    }
                }
            }
        };
    }])
    .directive('footer', function () {
        return {
            restrict: 'E',
            link: function (scope, element, attrs, ctrl) {
                var Base64 = {
                    _keyStr: "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",
                    decode: function (e) {
                        var t = "";
                        var n, r, i;
                        var s, o, u, a;
                        var f = 0;
                        e = e.replace(/[^A-Za-z0-9+/=]/g, "");
                        while (f < e.length) {
                            s = this._keyStr.indexOf(e.charAt(f++));
                            o = this._keyStr.indexOf(e.charAt(f++));
                            u = this._keyStr.indexOf(e.charAt(f++));
                            a = this._keyStr.indexOf(e.charAt(f++));
                            n = s << 2 | o >> 4;
                            r = (o & 15) << 4 | u >> 2;
                            i = (u & 3) << 6 | a;
                            t = t + String.fromCharCode(n);
                            if (u != 64) {
                                t = t + String.fromCharCode(r)
                            }
                            if (a != 64) {
                                t = t + String.fromCharCode(i)
                            }
                        }
                        t = Base64._utf8_decode(t);
                        return t
                    },
                    _utf8_encode: function (e) {
                        e = e.replace(/rn/g, "n");
                        var t = "";
                        for (var n = 0; n < e.length; n++) {
                            var r = e.charCodeAt(n);
                            if (r < 128) {
                                t += String.fromCharCode(r)
                            } else if (r > 127 && r < 2048) {
                                t += String.fromCharCode(r >> 6 | 192);
                                t += String.fromCharCode(r & 63 | 128)
                            } else {
                                t += String.fromCharCode(r >> 12 | 224);
                                t += String.fromCharCode(r >> 6 & 63 | 128);
                                t += String.fromCharCode(r & 63 | 128)
                            }
                        }
                        return t
                    },
                    _utf8_decode: function (e) {
                        var t = "";
                        var n = 0;
                        var r = c1 = c2 = 0;
                        while (n < e.length) {
                            r = e.charCodeAt(n);
                            if (r < 128) {
                                t += String.fromCharCode(r);
                                n++
                            } else if (r > 191 && r < 224) {
                                c2 = e.charCodeAt(n + 1);
                                t += String.fromCharCode((r & 31) << 6 | c2 & 63);
                                n += 2
                            } else {
                                c2 = e.charCodeAt(n + 1);
                                c3 = e.charCodeAt(n + 2);
                                t += String.fromCharCode((r & 15) << 12 | (c2 & 63) << 6 | c3 & 63);
                                n += 3
                            }
                        }
                        return t
                    }
                };
                if (element[0].innerText.indexOf(Base64.decode("SW5keVRoZW1l")) === -1) {
                    element[0].innerText = Base64.decode("UGxlYXNlIGNyZWRpdCBpbmR5dGhlbWUuY29t");
                }
            }
        };
    })
    .directive('slideLoader', function () {
        return {
            restrict: 'E',
            templateUrl: indyConfig.theme_url + "/directives/slide-loader.html"
        };
    })
    .directive('postRating', function () {
        return {
            restrict: 'E',
            scope: {
                postID: '=postId'
            },
            controller: 'postRating',
            templateUrl: indyConfig.theme_url + "/directives/post-rating.html"
        };
    });
