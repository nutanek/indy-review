var theme = angular.module('indyReview', []);

theme.run(function ($rootScope) {
        $rootScope.indyConfig = indyConfig;
    })
    .controller('header', ['$scope', '$rootScope', '$timeout', '$http', 'ratingServices', 
                function ($scope, $rootScope, $timeout, $http, ratingServices) {
            // ratingServices.get(32).then(function(data) {
            //     console.log("11111", data);
            // }, function(err) {
            //     console.log("11111", err);
            // });

            // ratingServices.getAvg(32).then(function(data) {
            //     console.log("111qqq11", data);
            // }, function(err) {
            //     console.log("11qqq111", err);
            // });
    }])
    .controller('article', ['$scope', '$timeout', function ($scope, $timeout) {
        var wrap = function (el, wrapper) {
            el.parentNode.insertBefore(wrapper, el);
            wrapper.appendChild(el);
        }
        angular.forEach(angular.element(document.querySelectorAll('.article__content img')), function (value, key) {
            var img = angular.element(value);
            if (img[0].classList.value.indexOf("aligncenter") !== -1) {
                img[0].style.marginLeft = "auto";
                img[0].style.marginRight = "auto";
            } else if (img[0].classList.value.indexOf("alignright") !== -1) {
                img[0].style.marginLeft = "auto";
            }
            img.addClass('img-responsive');
        });

        angular.forEach(angular.element(document.querySelectorAll('.article__content div[id^=attachment]')), function (value, key) {
            var attachment = angular.element(value);
            attachment[0].style.width = "";
        });

        angular.forEach(angular.element(document.querySelectorAll('embed, iframe')), function (value, key) {
            var iframe = angular.element(value);
            var responsiveIframe = document.createElement('div');
            responsiveIframe.className = "video-wrapper";
            wrap(value, responsiveIframe);
        });

    }])
    .controller('postRating', ['$scope', '$rootScope', 'ratingServices', function ($scope, $rootScope, ratingServices) {
        /******************* Declarations *******************/ 
        var lang = $rootScope.indyConfig.lang;
        $scope.lang = lang == 'th' || lang == 'th_TH' ? 'th' : 'en';
        $scope.selecting = false;
        $scope.ratingAvg = 0;
        $scope.emotion = [
            { img: '5.svg', title: { en: 'Great', th: 'สุดยอด' }, score: 5 },
            { img: '4.svg', title: { en: 'Good', th: 'ดี' }, score: 4 },
            { img: '3.svg', title: { en: 'Okay', th: 'เฉยๆ' }, score: 3 },
            { img: '2.svg', title: { en: 'Bad', th: 'แย่' }, score: 2 },
            { img: '1.svg', title: { en: 'Terrible', th: 'แย่มาก' }, score: 1 }
        ];
        /******************* Loading Data *******************/ 
        ratingServices.getAvg($scope.postID).then(function(data) {
            $scope.ratingAvg = data.avg;
        }, function(err) {
            // do noting
        });
        /******************* Functions *******************/ 
        $scope.isSelect = function() {
            $scope.selecting = true;
            $('[data-toggle="tooltip"]').tooltip();
        }
        $scope.notSelect = function() {
            $scope.selecting = false;
        }
        $scope.pushRating = function(score) {
            ratingServices.push($scope.postID, score).then(function(data) {
                if (!data.result) {
                    $scope.ratingAvg = data.data.avg
                }
            }, function() {
                // do noting
            });
        }
    }]);