#Overview

Before reading this, you should have a general understanding of [SMACSS](http://smacss.com/), CSS and the [SCSS](http://sass-lang.com/) syntax.

## Coding Style

* Use soft-tabs with a four space indent.
* Use `_` as space filler if the element name consist of more than one word `.some_element_name`
* Every property should be declared in a single line.
* Use one level of indentation for each declaration.
* Put spaces after `:` in property declarations.
* Use of `!important` should be avoided for all rule types with the exception of states rules.
* Use one discrete selector per line in multi-selector rulesets.
* Use single or double quotes consistently. Preference is for double quotes, e.g., `content: ""`.
* Where allowed, avoid specifying units for zero-values, e.g., `margin: 0`.
* Include a space after each comma in comma-separated property or function values.
* Use lowercase and shorthand hex values, e.g., `#aaa`.
* Opening bracket should be on the same line.
* Put spaces before `{` in rule declarations.
* Include a semi-colon at the end of the last declaration in a declaration block.
* Place the closing brace of a ruleset in the same column as the first character of the ruleset.
* Separate each ruleset by a blank line.

<br/>
Here is good example syntax:

```scss
// Good example
.some_class,
.another_class {
    background: #fff;
    display: block;
    -webkit-box-sizing: border-box;
    -moz-box-sizing: border-box;
    box-sizing: border-box;
    font-family: helvetica, arial, sans-serif;
    color: #333;
}
```

### Styling with selector's attributes
* Use `rel="prev"` and `rel="next"` to style the relationship between individual pages
* Use `<button>` for button that invokes an event or action and `<a>` are meant links that navigates to another page.
* An `<a>` should always have an `href` attribute and a valid `href` value.
* A button class should use `<button>`.
* Buttons in forms should have explicit types e.g. `type="submit"` `type="reset"`.
* ARIA label `aria-label` should be use to indicate the purpose of `<button>` and `<a>` if a text label is not visible on the screen.

```scss
// Rel use case
[rel="prev"] {
  /* styling for "previous links" */
}
[rel="next"] {
  /* styling for "next" links */
}

// href use case
a[href^="https:"] {
   /* style properties exclusive to secure pages */
}

// aria-label use case
<button type="button" aria-label="Close">X</button>
```

Please refer to [styling with selectors](http://coding.smashingmagazine.com/2013/08/20/semantic-css-with-intelligent-selectors/) for more semantic approach to styling web documents.


### Grouping of Properties
If declarations are to be consistently ordered, it should be in accordance with a single, simple principle.

1. Mixin 
2. Background 
3. Box Model
4. Positioning
5. Text 
6. Others

<br/>
Order of Property Declaration

```scss
.selector {
    // Mixins
    @extend .other-rule;
    @include clearfix();
    
    // Background
    background: none;

    // Box Model
    display: block;
    float: left;
    overflow: hidden;
    box-sizing: border-box;
    margin: 10px;
    padding: 10px;
    border: 10px solid #333;
    width: 100px;
    height: 100px;

    // Positioning
    position: absolute;
    z-index: 10;
    top: 0;
    right: 0;
    bottom: 0;
    left: 0;

    // Text   
    font-family: sans-serif;
    font-size: 16px;
    color: #fff;
    text-align: right;
    letter-spacing: -1px;

    // Other
    white-space: nowrap;
}
```

#### Exceptions and slight deviations
Long, comma-separated property values - such as collections of gradients or shadows - can be arranged across multiple lines in an effort to improve readability and produce more useful diffs. There are various formats that could be used; one example is shown below.

#### Nested Rules
When using SASS, the nested rules should come after the property declaration of the parent rules.

```scss
// Example of nested properties
.selector {
    display: block;
    margin-top: 10px;
    width: 100px;
    height: 100px;
    p {
        font-size: 11px;
        color: #444;
    }
}
```

## Comments Style
Take time to describe components, how they work, their limitations, and the way they are constructed.

Comment style should be simple and consistent within a single code base.

* Place comments on a new line above their subject.
* Make liberal use of section comment block to break CSS code into discrete sections.
* Use "sentence case" comments and consistent text indentation.
* Use `//` for single line comment blocks.
* Use `/* */` for multiple line comment blocks.
* use of `@` prefix in section comment block to allow easy search of code blocks.

<br/>
Example of a good comment:

```scss
/*========================================================================== */
/* @Section Comment Block
/*========================================================================== */
/*
 * Short description
 *
 * TODO: This is a todo statement that describes the task to be completed.
 * @param {Number} $param - description of input parameters
 * @return {Number} $return - description of return values
 */
```

## SCSS Style
LittleLives uses preprocessor [SCSS](http://sass-lang.com/) and [Compass](http://compass-style.org/).
* Use `-` as space filler if the variable name consist of more than one word. `$some-variable-name: .2em;`
* As a rule of thumb, don't nest further than **3 levels deep**. If you find yourself going further, think about reorganizing your rules (either the specificity needed, or the layout of the nesting).

## SCSS File Organization

The SCSS file organization should follow something like this:

    SCSS
    ├── globals 
    │   ├── base.scss 
    │   ├── buttons.scss 
    │   ├── forms.scss 
    ├── layouts
    │   ├── header.scss 
    │   └── sidebar.scss
    ├── modules
    │   ├── carousels.scss 
    │   └── dialogs.scss 
    ├── plugins 
    │   ├── jquery.UI.css 
    │   └── normalize.scss 
    └── pages     
        ├── attendance.scss     
        └── portfolio.scss

You should explicitly import any scss that does not generate styles i.e. scss files in `globals/` in the particular SCSS file you'll be needing. 

Here's an example:

```scss
@import "../globals/basic";

.rule { ... }
```

## Class naming conventions
Good naming convention is beneficial for immediately understanding which category a particular style belongs to and its role within the overall scope of the page. It also makes it easier to find which file a style belongs to. 

Giving meaningful names to an element style usually requires categorizing CSS rules. There are 4 types of categories:

1. Base
2. Layout
3. Module
4. State

<br/>
Each category has certain guidelines that apply to it. Much of the purpose of categorizing things is to codify patterns—things that repeat themselves within the design. Less repetition results in less code, easier maintenance, and greater consistency in the user experience. Exceptions to the rule can be advantageous but they should be justified.

Use a prefix to differentiate between Layout, State, and Module rules. For Layout, use `l_`. For State rules, use `is_` as in `is_hidden` or `is_collapsed`. This helps describe things in a very readable way. Modules are going to be the bulk of any project. As a result, having every module start with a prefix like `.module_` would be needlessly verbose. Modules just use the name of the module itself.

#### Using ID selectors
Avoid using ID attributes to style an element. They are reserved as hooks for JavaScript.

### 1. Base Rules 
Base rules are the defaults. They are almost exclusively single element selectors but it could include attribute selectors, pseudo-class selectors, child selectors or sibling selectors. It doesn’t include any class or ID selectors. It is defining the default styling for how that element should look in all occurrences on the page.

```scss
// Example of base styles
body, form {
    margin: 0;
    padding: 0;
}
a {
    color: #039;
}
a:hover {
    color: #03F;    
}
input[type=text] { 
    border: 1px solid #999; 
}
```

### 2. Layout Rules 
Layout rules divide the page into sections. Layout styles can also be divided into major and minor styles based on reuse. Major layout styles includes header and footer. Minor layout styles uses the grid system. Layouts usually hold one or more modules together.

Generally, a Layout style only has a single selector: a single ID or class name. However, there are times when a Layout needs to respond to different factors. For example, you may have different layouts based on user preference. This layout preference would still be declared as a Layout style and used in combination with other Layout styles. 

```scss
// Use of a higher level Layout style affecting other Layout styles.
.article {
    float: left;
}
.sidebar {
    float: right;
}
.l_flipped .article {
    float: right;
}
.l_flipped #sidebar {
    float: left;
}
```

In the Layout example, the .l_flipped class is applied on a higher level element such as the body element and allows the article and sidebar content to be swapped, moving the sidebar from the right to the left and vice versa for the article. One other thing to note in the Layout example is the naming convention, the use of `l_` prefix. This helps easily identify the purpose of these styles and separate them from **Modules** or **States**. 

### 3. Modules Rules 
Modules are the reusable, modular parts of our design. A module is a more discrete component of the page. It is our navigation bars and our carousels and our dialogs and widgets and so on. Each Module should be designed to exist as a standalone component. In doing so, the page will be more flexible. If done right, Modules can easily be moved to different parts of the layout without breaking.
 
Use the module names to prefix the module element. Related elements within a module should use the module base name as a prefix. For example a ticker module `.ticker` and its title text `.ticker_title`. We can instantly look at the title text class and understand that it is related to the ticker and where we can find the styles for that. Modules that are a variation on another module should also use the base module name as a prefix. 

When defining the rule set for a module, avoid using IDs and element selectors, sticking only to class names. A module will likely contain a number of elements and there is likely to be a desire to use descendent or child selectors to target those elements.

```scss
// Module example with descendent
.module > h2 {
    padding: 5px;
}
.module span {
    padding: 5px;
}
```

#### Avoid element selectors
Use child or descendant selectors with element selectors if the element selectors will and can be predictable. Using `.module span` in the above example is great if a span will predictably be used and styled the same way every time while within that module.

Here is another example of descendent selector:

```html
// Styling with generic element
<div class="fld">
    <span>Folder Name</span>
</div>
```
```scss
// The Folder Module
.fld > span {
    background: url(icon.png);
    padding-left: 20px;
}
```

The problem with the above example is that as a project grows in complexity, the more likely that we will need to expand a component’s functionality and the more limited we will be in having used such a generic element within your rule. What if the layout changes as shown in the example below?

```html
// Styling with generic element
<div class="fld">
    <span>Folder Name</span> 
    <span>(32 items)</span>
</div>
```

Now we are in a situation if we don’t want the icon to appear on both elements within our folder module. 

The solution to this is to use a selector that includes semantics. A `span` or `div` holds none. A heading has some. A class defined on an element has plenty. By adding the classes to the elements, we have increased the semantics of what those elements mean and removed any ambiguity when it comes to styling them.

```html
// Example of element with classes defined
<div class="fld">
    <span class="fld_name">Folder Name</span> 
    <span class="fld_items">(32 items)</span>
</div>
```

If you do wish to use an element selector, it should be within one level of a class selector. In other words, you should be in a situation to use child selectors. Alternatively, you should be extremely confident that the element in question will not be confused with another element. The more semantically generic the HTML element (like a `span` or `div`), the more likely it will create a conflict down the road. Elements with greater semantics like headings are more likely to appear by themselves within a container and you are more likely able to use an element selector successfully.

### 4. State Rules 
State rules are ways to describe how our modules or layouts will look when in a particular state. Is it hidden or expanded? Is it active or inactive? A state is something that augments and overrides all other styles. For example, an accordion section may be in a collapsed or expanded state. A message may be in a success or error state. A button may be in its active or non active state. They are also about describing how a module might look in different views like the home page or the inside page.

Points to take note:

* Use the `is_` prefix for state rules `is_hidden`, `is_active`, `is_tab_active`.
* State styles indicate a JavaScript dependency and are usually applied to elements to indicate a change in state while the page is still running on the client machine.

<br/>
An example of state applied to an element.

```html
// State applied to an element
<div id="header" class="is_collapsed">
    <form>
        <div class="msg is_error">
            There is an error!
        </div>
        <label for="searchbox" class="is_hidden">Search</label>
        <input type="search" id="searchbox">
    </form>
</div>
```

The header element in the example above just has an ID. As such we can assume that any styles, if there are any, on this element are for layout purposes and that the is-collapsed represents a collapsed state. One might presume that without this state rule, the default is an expanded state.

The msg module is simple enough and has an error state applied to it. One could imagine a success state could be applied to the message, alternatively. Finally, the field label has a hidden state applied to hide it from sight but still keep it for screen readers. In this case, we are actually applying the state to a base element and not overriding a layout or module.

#### Combining State Rules with Modules
Sometimes a state is very specific to a particular module where styling is very unique. In a case where a state rule is made for a specific module, the state class name should include the module name in it. The state rule should also reside with the module rules and not with the rest of the global state rules.

```scss
// State rules for modules
.tab {
    background-color: purple;
    color: white;
}
.is_tab_active {
    background-color: white;
    color: black;
}
```

#### Using !important
States should be made to stand alone and are usually built of a single class selector. Since the state will likely need to override the style of a more complex rule set, the use of `!important` is allowed. However leave **!important** off until you actually and truly need it. Remember, the use of !important should be avoided for all other rule types. Only states should have it.

### 5. JS Rules
Use `js_` prefix for javascript declared styles. Never reference `js_` prefixed class names from CSS files. It is used exclusively from JS files.

## Specificity: Depth of Applicability
HTML is like a tree structure of parents and children. The depth of applicability is the number of generations that are affected by a given rule. For example, `body.article > .main > .content > .intro > p > b` would have a depth of applicability of 6 generations. If this selector was written as `.article .intro b` then the depth is still the same: 6 generations.

Let’s review a typical block of CSS codes.

```scss
// How we tightly couple our CSS to our HTML
.sidebar div {
    border: 1px solid #333;
}
.sidebar div h3 { 
    margin-top: 5px;
}
.sidebar div ul {
    margin-bottom: 5px; 
}
```

By looking at this, we can see that there is some expectation of what our HTML will look like. There is likely one or more sections in a sidebar that have a heading and an unordered list that follows it. If the site doesn’t change very often, this style of CSS will work just fine. However using this approach on a larger site, which can change more frequently and have a greater variety of code requirements, we are going to have problems. We will need to add more rules with more complex selectors.

There are two particular concerns with the above example CSS:

1. Relying heavily on a defined HTML structure.
2. The depth of HTML to which the selectors apply is too deep.

### Minimizing the Depth
The problem with such a depth is that it enforces a much greater dependency on a particular HTML structure. Components on the page can't be easily moved around. If we look back at the sidebar example, how do we recreate that module in another part of the page such as a footer? We have to duplicate the rules.

```scss
// Duplication of rules
.sidebar div, .footer div {
    border: 1px solid #333;
}
.sidebar div h3, .footer div h3 { 
    margin-top: 5px;
}
.sidebar div ul, .footer div ul {
    margin-bottom: 5px; 
}
```

As we can see from the above example, the root node is at the `div` and it is from here that we should be creating our styles. The solution is to add classes to the `div` elements.

Here is a good example of minimizing depths:

```scss
// Simplification of rules
.pod {
    border: 1px solid #333;
}
.pod > h3 { 
    margin-top: 5px;
}
.pod > ul {
    margin-bottom: 5px; 
}
```

The `.pod` class name given to the `div` container still relies on a particular HTML structure but it is of a much shallower depth than what we had before. The trade-off is that we have to repeat the pod class on numerous elements on the page. An advantage to using this shallow depth of applicability approach is also the ability to more readily convert these modules into templates for dynamic content. 

Trying to strike a balance between maintenance, performance, and readability. Going too deep may mean less classes within your HTML but it increases the maintenance and readability overhead. Likewise, you don’t want (or need) classes on everything.

Consider the HTML codes for the above example:

```html
<div class="pod">
    <h3>title</h3>
    <ul>
        <li>item 1</li>
        <li>item 2</li>
    </ul>
</div>
```

Adding classes to the `h3` or `ul` in this example would have been a little unnecessary unless we needed to have an even more flexible system. To go even further on this last example, this design pattern is a common one. It is a container with a header and a body. We have a `ul` in there right now but in other examples, we might see an `ol` or a `div` in its place.

Once again, we can duplicate our rules for each variation.

```scss
// Duplication of rules
.pod > ul, .pod > ol, .pod > div {
    margin-bottom: 5px; 
} 
```
Alternatively, we can classify the pod body.

```html
//Simplifying with a class
<div class="pod">
    <h3>title</h3>
    <ul class="pod_body">
        <li>item 1</li>
        <li>item 2</li>
    </ul>
</div>
```
```scss
.pod_body {
    margin-bottom: 5px; 
}
```

With the module rule approach, we can visually see that `.pod_body` is associated with the pod module and from a code perspective, it’ll work just fine. As a result of this small change, we were able to reduce the depth of applicability to the shallowest it can go. The single selector also means that we are avoiding potential specificity issues, too.
