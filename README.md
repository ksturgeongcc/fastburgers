# fastburgers Brief

You have been asked to design and interrogate a RDBMS for a fast food franchise FastBurgers with over 100 outlets in the UK. The database is a prototype to cover a specific part of their ordering system.
The owner of the franchise wants to see which member of staff takes the most orders and what are the most popular orders taken.
The owner wants to track if the customer pays by cash or card. The owner can then collate this information for all the outlets. There are two menus that the customer can chose from — the regular menu and the savers menu. All of the products sold should either be on the regular menu or on the savers menu. The regular menu has a breakfast section that finishes at 11am each day. The savers menu has a start and
end date and is changed monthly. For example in December they will have a festive savers menu.
The order system should track:

Which customer places which order.
# show table with following details
# customer orders
# show order with - date, customer name, menu, payment type
# view customer details

All items on that order.
Which member of staff took that order.
# view full order details
# show member of staff

Shifts for both managers and sales staff.
# show shifts

Other important information to note:

The two managers of each outlet also take orders.
The cooks do not take orders directly from customers.
Each item should relate to a food/drink product.
Stock should also be tracked with automatic request to restock if burgers go down to 500. Chips (1 kilo bags) less than 200, etc.
The manager is responsible for keeping the stock up to date.



