#lang scheme
; upr. 3
;zad. 1
(define (F x)
  (if (> x 5)
      (+ (- (* 10 x) (* 5 x)) 5)
      (- 100 (* 20 x) (* 15 x))
      )
  )

;zad. 2
(define (Between x)
  (if (and (>= x 5) (<= x 10))
      "Yes"
      "No")
  )

;zad. 3 simple if
(define (DiscriminantFind a b c)
  (- (expt b 2)
     (* 4 a c ))
  )

(define (HasTwoRoots a b c)
  (if (> (DiscriminantFind a b c) 0)
      "Yes"
      "No"
      )
  )

;zad. 3 with cond
(define (CheckRoots a b c)
  (cond
    ((> (DiscriminantFind a b c) 0) "Has two roots")
    ((= (DiscriminantFind a b c) 0) "Has one root")
    (else "No roots")
    )
  )

;zad. 4
(define (IsBetween x)
  (if(or
      (and (> x 1) (< x 6))
      (and (> x 16) (< x 21)))
     
     "Yes"
     "No")
  )

;zad. 5
(define (FindSolution x)
  (cond
    ((> x 2)
     (+ (- (expt x 2) x) 4)) ; x^2-x+4
    ((and (>= x 1) (<= x 2))
     (/ 1 x))
    (else 0)
    )
  )

;zad. 6
(define (FindSmaller a b)
  (cond
    ((< a b) (* a 2))
    ((< b a) (* b 2))
    (else a))
  )

;zad. 7
(define (Chat message)
  (cond
    ((string=? message "Hi") "Hi, how are you?")
    ((string=? message "How are you?") "Fine, thank you!")
    (else "I’m waiting!")
    )
  )

