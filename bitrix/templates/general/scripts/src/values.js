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
		loadImgTimeout: 30000, // ms
		bitrixCorrectionInterval: 500 // ms
	};

	/** Required set before "getVal" */
	exports.required = [
		'lang',
		'revision',
		'tplPath'
	];

	return exports;

}); // define
