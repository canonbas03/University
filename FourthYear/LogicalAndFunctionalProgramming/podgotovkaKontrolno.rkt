#lang scheme

; Podgotovka za kontrolna rabota
; zad. 1

(let ((x (/ 1 3)) (y (expt 3 2)))
(+ (* x (expt y 2)) (* 3 (expt x 5)) (* 7 (expt y 2)))
  )

((lambda (x y)
  (+ (* x (expt y 2)) (* 3 (expt x 5)) (* 7 (expt y 2))))
  (/ 1 3)(expt 3 2))

; zad. 2
(let ((x (+ 2 5))(y (expt 2 3))) (+ (* x y)(* 2 x)(* 3 y)))

((lambda (x y)
   (+ (* x y)(* 2 x)(* 3 y)))
 (+ 2 5) (expt 2 3)
 )

; zad. 3
((lambda (x y)(sqrt (+ (expt x 2)(expt y 3)))) 5 6)

(let ((x 5) (y 6))
  (sqrt (+ (expt x 2)(expt y 3))))

; zad. 4
(define (inInterval num)
(cond
  ((and (> num 3) (< num 10)) 'Yes)
  (else 'No)
  ))

; zad. 5
(define (ap-product a b)
(cond
  ((> a b) 1)
  (else (* a (ap-product (+ a 2) b)))
  ))

; zad. 6
(define (zeroCount lst)
(cond
((null? lst)0)
((= (car lst) 0) (+ 1 (zeroCount (cdr lst))))
(else (zeroCount (cdr lst)))
  ))

; zad. 7
(define (listOfEven lst)
(cond
((null? lst) '())
((= (modulo (car lst) 2) 0) (cons (expt (car lst) 4) (listOfEven (cdr lst))))
(else (listOfEven (cdr lst)))
  ))

; zad. 8
(define (isTriangle a b c)
(cond
  ((or (<= a 0) (<= b 0) (<= c 0) (<= (+ a b) c) (<= (+ a c) b) (<= (+ b c) a)) 0)
  ((= a b c) 3)
  ((or (= a b) (= a c) (= b c)) 2)
  (else 1)
  ))