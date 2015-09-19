#!/usr/bin/env python
# -*- coding: UTF-8 -*-# enable debugging
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
    print s
