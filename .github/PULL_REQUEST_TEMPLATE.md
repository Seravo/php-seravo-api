## Description

Describe the new feature you're adding or the bug you're fixing.

A clear and concise description of what the new feature is, or what is the
existing issue you're now fixing, and how it improves our existing tools,
workflows and service we provide to the customer.

Ie. "why we are doing this", and any related issues or other information.
Especially bugs should always have existing bug reports with enough details to
help the reviewer to ensure that bug is really fixed.


Related: #xxx

Closes: #xxx


## Impact assessment

Conflict between these details and the actual implementation is considered as
critical bug, preventing the merge. Ie. reviewer must reject PR if such
conflicts exist.

Justify your decision.


#### Users

What user groups are affected by this change? Ie. 
- Seravo Staff
  - [ ] Customer Success
  - [ ] Systems
  - [ ] Development
  - [ ] Billing
 - [ ] Miss Group or any subsidiary
 - [ ] Customer (the entity that pays for our service)
 - [ ] Other: describe

Remember to describe how, ie. if some feature changes/is added/access is
limited etc.


#### Services

Does this feature interact with other services: either internal or third-party?


#### Security and privacy

Does this feature impact security or data privacy and if yes, how?

Eg. does this change affect the visibility of services (eg. expose new
endpoints), security configuration, or eg. how we handle Personally
Identifiable Information (PII)? Or eg. does this begin creating new PII?


##### Confidentiality

Does this feature affect the Confidentiality?


##### Integrity

Does this feature affect the Integrity?


##### Availability

Does this feature affect the Availability?


##### Privacy

What classes of personally identifiable information (PII) is being created
after this feature is implemented? What PII this feature handles?


#### Processes and workflows

Does this change impact companys internal processes or workflows, ie. how we do
certain tasks - whether tasks is done by automation or by human?


### Alternatives

Describe alternatives you've considered. A clear and concise description of any
alternative solutions or features you've considered.


## Definition of Done

The Definition of Done should encapsulate all of the items that must be checked
off in order to consider the product shippable.

 - [ ] Code tested by author
 - [ ] Automatic tests written (positive + negative)
 - [ ] Documentation written
 - [ ] Release notes written
 - [ ] Internal communications plan created
 - [ ] External communications plan created
 - [ ] Security impact assessment done
 - [ ] Data Privacy impact assessment done

When fixing bugs, your tests should always test that bug can't resurface later.


## Notes for reviewer

### Where should a reviewer start?

### Manual testing steps?

### Screenshots

## Related

Any related material, upstream documentation, or other material that makes it
easier to assess the impact and quality of the change.