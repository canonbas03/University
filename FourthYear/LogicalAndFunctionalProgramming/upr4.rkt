#lang scheme
; upr. 4
; zad. 1
(let ((a 3)
      (b 4))
  (* a b))

; zad. 2
((lambda (x y)
(+ (expt x 3) (expt y 4)))
  1 1)

; zad. 3
(let ((x 1) (y 1))
(+ (expt x 3) (expt y 4)))

; zad. 4
((lambda (a b)
   (expt a b))
 (- 16 2) (* 4 2.25))

; zad. 5
(let ((x 2) (y 3) (z 4))
  (* x y z))

; zad. 6
(define (findXY x y)
(+ (* (+ x 2) 2 y)
   (*(- y 1)x)
   (*(+ x 2) (- y 1) x y))
  )

; zad. 6 ver.2
(define (findXYlet x y)
(let((a (+ x 2))
     (b (- y 1)))
  (+ (* a 2 y)
     (* b x)
     (* a b x y))
  ))

; zad. 7
(define (SquareRoot a b c)
(let ((p (/ (+ a b c) 2)))
  (sqrt(* p
          (+ p a)
          (+ p b)
          (+ p c)))
  ))

; zad. 8
(let* ((x 2)
       (y (+ x 5)))
(+ x y))

; zad. 8 with func
(define (SumXY)
(let* ((x 2)
       (y (+ x 5)))
(+ x y)))

