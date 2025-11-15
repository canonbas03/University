#lang scheme
; zad. 1
(define (findOdds lst)
(cond
 ((null? lst) '())
 ((= (modulo (car lst) 2) 1) (cons (car lst) (findOdds ( cdr lst))))
 (else (findOdds (cdr lst)))
  ))

; zad. 2
(define (exptList lst)
(cond
  ((null? lst) '())
  (else (cons (expt (car lst) 2) (exptList(cdr lst))))
  ))

; zad. 3
(define (multiplyByTwo lst)
(cond
  ((null? lst) '())
  (else (cons (* (car lst) 2) (multiplyByTwo (cdr lst))) )
  ))

; zad. 4
(define (addUnique lst elem)
(cond
  ((null? lst) (list elem))
  ((= (car lst) elem) lst)
  (else (cons (car lst) (addUnique (cdr lst) elem)))
  ))

; zad. 5
(define (compareList lst1 lst2)
(cond
  ((and (null? lst1) (null? lst2)) #t)
  ((or (and (null? lst1) (not (null? lst2)))
       (and (not (null? lst1)) (null? lst2))) #f)
  ((not (= (car lst1) (car lst2))) #f)
  (else (compareList (cdr lst1) (cdr lst2)))
  ))

; zad. 6
(define (signChanges lst)
(cond
  ((or (null? lst) (= (length lst) 1)) 0)
  ((< (* (car lst) (cadr lst)) 0) (+ 1 (signChanges (cdr lst))))
  (else (signChanges (cdr lst)))
  ))

; zad. 7
(define (positiveNeg lst)
(cond
  ((or (null? lst) (= (length lst) 1)) 0)
  ((and (> (car lst) 0) (< (cadr lst) 0)) (+ 1 (positiveNeg (cdr lst))))
  (else (positiveNeg(cdr lst)))
  ))

; zad. 8
(define (evenToThird lst)
(cond
  ((null? lst) '())
  ((= (modulo (car lst) 2) 0) (cons (expt (car lst) 3) (evenToThird (cdr lst))))
  (else (evenToThird (cdr lst)))
  )
  )

; zad. 9
(let ((x (+ 2 5)) (y (expt 2 3))) (+ (* x y) (* 2 x) (* 3 y)))

((lambda (x y)
(+ (* x y) (* 2 x) (* 3 y)))
  (+ 2 5) (expt 2 3))

; zad. 10
((lambda (x y) (sqrt (+ (expt x 2) (expt y 3)))) 5 6)

(let ((x 5) (y 6))
(sqrt (+ (expt x 2) (expt y 3)))
  )

; zad. 11
(define (makeTriangle a b c)
  (cond
    ((or (<= a 0) (<= b 0) (<= c 0) (<= (+ a b) c) (<= (+ a c) b) (<= (+ b c) a)) 0)
    ((= a b c) 3)
    ((or (= a b) (= b c) (= a c)) 2)
    (else 1)
   ))






















































