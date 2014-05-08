/**
 * Values for "get_val" module
 *
 * @author Viacheslav Lotsmanov
 */

define(function () {

	/** @public */ var exports = {};

	exports.values = {
		animationSpeed: 200,
		objectsBlockRatio: [4, 3],
		dynamicApiLoadInterval: 100, // ms
		requireTimeout: 60, // sec
		loadImgTimeout: 30000 // ms
	};

	/** Required set before "getVal" */
	exports.required = [
		'lang',
		'revision',
		'tplPath'
	];

	return exports;

}); // define

// vim: set noet ts=4 sts=4 sw=4 fenc=utf-8 foldmethod=marker :
