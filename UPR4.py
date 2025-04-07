# Exercise 2
"""
count = 0
while count < 5:
    print(count)
    count += 1

# Exerecise 3
count = 0
while count < 5:
    print("В цикъла:", count)
    count += 1
else:
    print("В else:", count)


# Exercise 4
count = 0
while count < 5:
    count += 1
    print("Преди break:", count)
    if count == 3:
         break 
    # Ако count = 3, излизаме от цикъла


#####################################################################

#Individual 
# Exercise 1
num1 = int(input("Insert Value 1: "))
num2 = int(input("Insert Value 2: "))

while num1 <= num2:
    print(num1)
    num1 += 1


# Exercise 2
check = int(input("N: "))
total = 0
for number in range(1,check+1):
    total += number
print(total)

# Exerecise 3

number = int(input("Number: "))
counter = 1

while counter <= 10:
    print(f"%i x %i = {number * counter}" %(number, counter))
    counter +=1



# Exercise 4

counter = 0
while counter <= 10:
    counter += 1
    if counter % 2 != 0:
        continue
    print(counter)
    


# Exercise 5

userInputs = int(input("How many numbers: "))

calcNum = 1

while calcNum <= userInputs:
    cislo = int(input("Write a number: "))
    calcNum +=1
    if cislo < 0:
         print("!!!")
         break
    

# Exercise 7
count = 0
while count < 3:
    print(count)
    count +=1
else:
    print("The cycle finished")
    

# Exercise 9
n = int(input("Type the number"))
sum = 0
while n > 0:
    num = n % 10
    sum += num
    n //= 10 # // for deletion
print(sum)


#Exercise 13
cislo = 10
while cislo >= 1:
    print(cislo)
    cislo -=1

#Exercise 13.1 
cisloS = int(input("Start: "))
cisloF = int(input("Finish: "))
while cisloF >= cisloS:
    print(cisloF)
    cisloF -=1


# Exercise 14
cislo = int(input("Number: "))
factorial = 1
for i in range(1,cislo+1):
    factorial = factorial * i
print(factorial)



cislo = 30
for i in range(1,cislo+1):
    if(i % 5 == 0 and i % 3 == 0):
        print("FizBuzz")
    elif(i % 3 == 0):
        print("Fizz")
    elif(i % 5 == 0):
        print("Buzz")
    else:
        print(i)


# HOMEWORK

# Exercise 1
cislo = 5
text = ''
for i in range(1,cislo):
    for k in range(0,cislo-i):
        text += " "
    for y in range(0,(2*i-1)):
        text += "*"
    print(text)
    text=''

# Exercise 2
cislo = 5
text = ""

for i in range(1,cislo+1): # From 1 to 6
    for k in range(0,cislo-i): # From 0 to 4, 0 to 3, 0 to 2, 0 to 1, 0 to 0
        text += " " # Put 4 spaces, 3, 2, 1, 0
    for y in range(0,(2*i-1)): # From 0 to 1, 0 to 3, 0 to 5, 0 to 7, 0 to 9
        text += "*" # Put 1 *, 3, 5, 7, 9
    print(text)
    text =""

for i in range(0,cislo): # From 0 to 5
    for k in range(0,(i+1)): # 0 to 1, 0 to 2, 0 to 3
        text += " "
    for y in range((2*i-1),cislo + 1): # From -1 to 6, 1 to 6, 3 to 6, 5 to 6
        text += "*"
    print(text)
    text=""
"""
# Exercise 3
cislo = int(input("Height: "))
trunk = int(input("Trunk size: "))
text = ''
for i in range(1,cislo+1):
    for k in range(0,cislo-i):
        text += " "
    for y in range(0,(2*i-1)):
        text += "*"
    print(text)
    text=''


for y in range(0, trunk):
    for k in range(0,cislo-1):
        text += " "
    text += "*"
    print(text)
    text = ""



