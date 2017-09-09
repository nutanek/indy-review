var theme = angular.module('indyReview', []);

theme.run(function($rootScope) {
    $rootScope.indyConfig = indyConfig;
});

theme.controller('header', ['$scope', '$rootScope', '$timeout', function($scope, $rootScope, $timeout) {
   
}]);


theme.controller('article', ['$scope', '$timeout', function($scope, $timeout) {

    var wrap = function (el, wrapper) {
        el.parentNode.insertBefore(wrapper, el);
        wrapper.appendChild(el);
    }

    angular.forEach(angular.element(document.querySelectorAll('.article__content img')), function(value, key) {
        var img = angular.element(value);
        if (img[0].classList.value.indexOf("aligncenter") !== -1) {
            img[0].style.marginLeft = "auto";
            img[0].style.marginRight = "auto";
        } else if (img[0].classList.value.indexOf("alignright") !== -1) {
            img[0].style.marginLeft = "auto";
        }
        img.addClass('img-responsive');
    });

    angular.forEach(angular.element(document.querySelectorAll('.article__content div[id^=attachment]')), function(value, key) {
        var attachment = angular.element(value);
        attachment[0].style.width = "";
    });

    angular.forEach(angular.element(document.querySelectorAll('embed, iframe')), function(value, key) {
        var iframe = angular.element(value);
        var responsiveIframe = document.createElement('div');
        responsiveIframe.className = "video-wrapper";
        wrap(value, responsiveIframe);
    });

}]);
