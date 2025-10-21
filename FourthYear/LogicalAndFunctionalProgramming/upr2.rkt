#lang scheme
; upr. 2
;zad 1
(define (squared x)
  (expt x 3)
  )

;zad. 2a
(define (FindX x)
  (+
   (-(* 5 (expt x 2))(* 2 x)) ;5x^2
   10)
  )

;zad. 2a
(define (XFinder x)
 (+
  (- (* 5 (expt x 2)) (* 2 x)) ; 5x^2 - 2x
  10)
)

;zad. 2b
(define (PFind p)
(sqrt
 (* (* p (+ p 10)) ; p * (p + 10)
    (+ p 20) ;p + 20
    (+ p 30)) ; p + 30 
      )
  )

;zad. 2c
(define (CFind x)
(- 11
   (+ (* 2 (sqrt(+ 1 x)))   ; 2*sqrt(x+1)
      (sqrt( + (* 3 x) 1))) ; sqrt(3x+1)
   )
  )

;zad. 2d
(define (YFind y)
(/ (sqrt(+ (expt y 2) y (* 5 y) 100)) ; y^2+y+5y+100
   (* 2 y))                               ; 2y
  )

;zad. 3
(define (FindDifference a b)
(- (expt a 2) (expt b 2)) ; a^2 - b^2
  )

;zad. 4
(define (FindArea r)
(* pi (expt r 2) )
  )

;zad. 5
(define (SumAreas r)
(+ (* pi (expt r 2))            ; pi * r^2
   (* pi (expt(+ r 10) 2)) ) ; pi * (r+10)^2
  )

;zad. 6
(define (Discriminant a b c)
(- (expt b 2)
   (* 4 a c))
  )

;zad. 7
(define (ConvCToF c)
(+
 (* c (/ 9 5)) ; C*9/5
 32)
  )

;zad. 8
(define (FindProfit guests)
(- (* guests 5)
   (+ 20 (* guests 0.5)))
  )

;zad. 9
((lambda (x y)
(-
 (+ (expt x 2)
    (* 10 y)) ;x^2+10y
 20))
 5 3 )

;zad. 10
((lambda (a b)
   (* (expt a 2) (expt b 3)))
 2 3)

;zad. 11
(define (GrandTotal x y)
(* (* x 1.08) ; 100 -> 108
   (+ (/ y 100) 1)) ; 108 * 1.15 
  )
