/******/ (() => { // webpackBootstrap
/******/ 	"use strict";
/*!****************************************!*\
  !*** ./resources/js/completedExams.ts ***!
  \****************************************/


document.addEventListener('DOMContentLoaded', function () {
  var contactButtons = document.querySelectorAll('.contact-button');
  contactButtons.forEach(function (button) {
    button.addEventListener('click', function () {
      var answer = button.nextElementSibling;
      if (answer) {
        answer.classList.toggle('hidden');
      }
    });
  });
  var faqQuestions = document.querySelectorAll('.faq-question');
  faqQuestions.forEach(function (question) {
    question.addEventListener('click', function () {
      var answer = question.nextElementSibling;
      if (answer) {
        answer.classList.toggle('hidden');
      }
    });
  });
});
/******/ })()
;