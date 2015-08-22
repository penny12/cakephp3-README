top_srcdir   = /usr/local/apache2/httpd-2.2.29
top_builddir = /usr/local/apache2/httpd-2.2.29
srcdir       = /usr/local/apache2/httpd-2.2.29/test
builddir     = /usr/local/apache2/httpd-2.2.29/test
VPATH        = /usr/local/apache2/httpd-2.2.29/test

# no targets: we don't want to build anything by default. if you want the
# test programs, then "make test"
TARGETS =

PROGRAMS =

PROGRAM_LDADD        = $(EXTRA_LDFLAGS) $(PROGRAM_DEPENDENCIES) $(EXTRA_LIBS)
PROGRAM_DEPENDENCIES =  \
	$(top_srcdir)/srclib/apr-util/libaprutil.la \
	$(top_srcdir)/srclib/apr/libapr.la

include $(top_builddir)/build/rules.mk

test: $(PROGRAMS)

# example for building a test proggie
# dbu_OBJECTS = dbu.lo
# dbu: $(dbu_OBJECTS)
#	$(LINK) $(dbu_OBJECTS) $(PROGRAM_LDADD)
