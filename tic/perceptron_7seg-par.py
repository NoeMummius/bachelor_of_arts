# -*- coding: utf-8 -*-
"""
Created on Tue Apr 21 08:04:21 2020

@author: Noé Muñoz Pérez
"""

# We need this to initialize python packages
import random

class Perceptron:
    def __init__(self,input_number,step_size=0.1):
        self._ins = input_number
        self._w = [random.random() for _ in range(input_number)]
        self._eta = step_size

    def predict(self,inputs):
        weighted_average = sum(w*elm for w,elm in zip(self._w,inputs))
        if weighted_average > 0:
            return 1
        return 0

    def train(self,inputs,ex_output):
        output = self.predict(inputs)
        error = ex_output - output
        if error != 0:
            self._w = [w+self._eta*error*x for w,x in zip(self._w,inputs)]
        return error

#!/usr/bin/env python
#from perceptron import Perceptron

## Datos de números y paridad
## segmentos, paridad
input_data = [[1,1,1,1,1,1,0,1],
              [0,1,1,0,0,0,0,0],
              [1,1,0,1,1,0,1,1],
              [0,1,1,0,0,1,1,1],
              [1,0,1,1,0,1,1,0],
              [1,1,1,1,1,1,1,1],
              [1,1,1,0,0,1,1,0]]

## Creamos el perceptron
pr = Perceptron(8,0.1) # Perceptron con 3 entradas
weights = [] # Lista con los pesos
errors = []  # Lista con los errores

## Fase de entrenamiento
for _ in range(100):
    # Vamos a entrenarlo varias veces sobre los mismos datos
    # para que los 'pesos' converjan
    for person in input_data:
        output = person[-1]
        inp = [1] + person[0:-1] # Agregamos un uno por default
        weights.append(pr._w)
        err = pr.train(inp,output)
        errors.append(err)
d=[]
for s in range(0,7):
 d.append(float(input("Introduce el valor del segmento %d.- "%(s + 1))))
##w = float(input("Introduce el color promedio.- "))

if pr.predict([1,d[0],2]) == 1: print ("Par")
else: print ("Impar")
