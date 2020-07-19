/*
   +----------------------------------------------------------------------+
   | Xdebug                                                               |
   +----------------------------------------------------------------------+
   | Copyright (c) 2002-2020 Derick Rethans                               |
   +----------------------------------------------------------------------+
   | This source file is subject to version 1.01 of the Xdebug license,   |
   | that is bundled with this package in the file LICENSE, and is        |
   | available at through the world-wide-web at                           |
   | https://xdebug.org/license.php                                       |
   | If you did not receive a copy of the Xdebug license and are unable   |
   | to obtain it through the world-wide-web, please send a note to       |
   | derick@xdebug.org so we can mail you a copy immediately.             |
   +----------------------------------------------------------------------+
   | Authors: Derick Rethans <derick@xdebug.org>                          |
   |          Michael Voříšek <mvorisek@mvorisek.cz>                      |
   +----------------------------------------------------------------------+
 */

#ifndef __XDEBUG_TIMING_H__
#define __XDEBUG_TIMING_H__

#define NANOS_IN_SEC      1000000000
#define NANOS_IN_MICROSEC 1000

#if PHP_WIN32
typedef void (WINAPI *WIN_PRECISE_TIME_FUNC)(LPFILETIME);
#endif

typedef struct _xdebug_nanotime_context {
	uint64_t start_abs;
	uint64_t start_rel;
	uint64_t last_abs;
	uint64_t last_rel;
#if PHP_WIN32
	WIN_PRECISE_TIME_FUNC win_precise_time_func;
	uint64_t win_freq;
#endif
} xdebug_nanotime_context;

xdebug_nanotime_context xdebug_nanotime_init(void);

uint64_t xdebug_get_nanotime(void);
double xdebug_get_utime(void);
char* xdebug_get_time(void);

char* xdebug_nanotime_to_chars(uint64_t nanotime, unsigned char precision);

#endif
