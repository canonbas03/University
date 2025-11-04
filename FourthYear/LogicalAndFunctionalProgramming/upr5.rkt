#lang scheme

; Upr. 5
; zad. 1
(define(factorial n)
(if(= n 1)
1
(* n (factorial(- n 1))))
)

; zad. 2
(define (count x)
(if (= (quotient x 10) 0)
    1
    (+ 1 (count(quotient x 10))))
  )

; zad. 3
(define (hasSeven x)
(cond
  ((= x 0) "Does not contain 7")
   ((= (remainder x 10) 7) "Found 7")
   (else (hasSeven(quotient x 10))))
  )

;zad. 4
(define (progression n)
(cond
((= n 1) 1)
 ((= (remainder n 3) 1) (* n (progression(- n 3))))
(else (progression(- n 1)))
 )
  )

; Zad. 5
(list 1 3 5 8)
(list (list 7 8) 2 3)

; Zad. 6
(car '(1 2 3 4))

; Zad. 7
(cdr '(1 2 3 4))

; Zad. 8
(car (cdr '(1 2 3 4)))

; Zad. 9
(define (sumRecursive list)
(cond
  ((null? list) 0)
(else(+ (car list) (sumRecursive (cdr list))))
  )
  )