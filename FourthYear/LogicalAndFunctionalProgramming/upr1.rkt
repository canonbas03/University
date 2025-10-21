#lang scheme
; upr. 1
#| ;zad. 1
   ;a)
   (- (* 0.4 (- 41 (/ 22 3))) 19.5)
   ;b  (5/3 + 10/2) / (5/8 – 10/7)
   (/ (+(/ 5 3) (/ 10 2)) (- (/ 5 8) (/ 10 7)))
   ;v
   (/ (+ (* 5 5) (expt 8 3)) (* 2.5 5))
   
   ;zad. 2
   (positive? (/ (- 120 50) 3))
   (negative? (/ (- 120 50) 3))
   
   ;zad. 3
   (even? (/ 25 0.2))
(odd? (/ 25 0.2))

;zad. 4

(make-string 3 #\A)

;zad. 5
"This is a string!"
 

;zad. 6
(list '1 '3 '5' 7 '9)

;zad. 7
(vector '3 '5 '8)

;zad. 8
(string-ref "Windows 10" 3)

;zad. 9
(string-length "Windows 10")

;zad. 10
(string-append "Hello " "word")
|#
;zad. 11
(string->list "Yes!")
;zad. 12
(define pi 3.14)
(define r 11)
;zad. 13
(define(s pi r)(* pi (expt r 2)))
(s pi r)
;zad. 14
(s pi 5)
;zad. 15
(define sp (list '4 '8 '3))
;zad. 16
(define str "Windows 11")
(define sym (string-ref str 2 ))
(define length (string-length str))
