#!/usr/bin/env python
# -*- coding: UTF-8 -*-# enable debugging
import cgitb
cgitb.enable()
import ROOT
import tempfile
f = ROOT.TFile("../data/ZbblowMET_smallMll_RewFormformulaPol3NLO_PAS.root")
tcanvas = f.Get("Combined/jetmetMET")
out = tempfile.NamedTemporaryFile(suffix=".svg")
tcanvas.SaveAs(out.name)
s = out.read()
print "Content-Type: image/svg+xml"
print
print s

