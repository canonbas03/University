#lang scheme
; zad. 1
(car (cdr (cdr '(1 2 3 4 5))))

; zad. 2
(define z '(1 (2 3) 4))

(car (car (cdr z)))
(caadr z)

; zad. 3
(reverse '(2 4 6 8))

(define (my-reverse lst)
(if(null? lst)
'()
(append (my-reverse (cdr lst)) (list (car lst)))
   )
)

; zad. 4
(length '(1 2 3))

; zad. 5
(define (counter lst)
(if (null? lst)
  0
  (+ 1 (counter (cdr lst)))
  ))

; zad. 6
(define (countZero lst)
(cond
  ((null? lst) 0)
  ((= (car lst) 0) (+ 1 (countZero (cdr lst))))
  (else (countZero (cdr lst)))
  ))

; zad. 7
(define (listProduct lst)
(cond
((null? lst) 1)
(else (* (car lst) (listProduct (cdr lst))))
  ))

; zad. 8
(define (mergeTwo lst1 lst2)
(cond
((null? lst1) lst2)
(else (cons (car lst1) (mergeTwo (cdr lst1) lst2))
  )
  ))
