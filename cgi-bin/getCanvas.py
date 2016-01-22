#!/usr/bin/env python
# -*- coding: UTF-8 -*-# enable debugging
import sys
sys.path.append('/usr/lib/root/')
import cgi
import cgitb
cgitb.enable()
import ROOT
import tempfile
print "Content-Type: image/svg+xml"
print
parameters = cgi.FieldStorage()
if parameters.has_key("file") and parameters.has_key("canvas"):
    filename = parameters["file"].value
    canvas = parameters["canvas"].value
    f = ROOT.TFile(filename)
    tcanvas = f.Get(canvas)
    out = tempfile.NamedTemporaryFile(suffix=".svg")
    tcanvas.SaveAs(out.name)
    s = out.read()
    key = canvas.split("/")[-1]
    print "<!--"+key+"-->"
    print s
